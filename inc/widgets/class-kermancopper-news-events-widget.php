<?php

class KermanCopper_News_Events_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'kermancopper_news_events',
            __( 'مس کرمان: اخبار و رویدادها', 'kermancopper' ),
            array( 'description' => __( 'نمایش اخبار و رویدادها با استایل‌های متنوع و تنظیمات پیشرفته', 'kermancopper' ), )
        );
    }

    private function get_defaults() {
        return array(
            'title'          => __( 'اخبار و رویدادها', 'kermancopper' ),
            'strapline'      => '',
            'categories'     => array(),
            'order_by'       => 'date_desc',
            'show_date'      => 1,
            'date_format'    => 'gregorian',
            'posts_per_page' => 6,
            'style'          => 'frontpage',
            'views_meta_key' => 'post_views',
        );
    }

    private function format_jalali_date( $date_string ) {
        $parts = explode( '-', $date_string );
        if ( count( $parts ) !== 3 ) {
            return $date_string;
        }
        $gy = (int) $parts[0];
        $gm = (int) $parts[1];
        $gd = (int) $parts[2];
        $g_d_m = array( 0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334 );
        $gy2 = ( $gm > 2 ) ? ( $gy + 1 ) : $gy;
        $days = 355666 + ( 365 * $gy ) + (int) ( ( $gy2 + 3 ) / 4 ) - (int) ( ( $gy2 + 99 ) / 100 ) + (int) ( ( $gy2 + 399 ) / 400 ) + $gd + $g_d_m[ $gm - 1 ];
        $jy = -1595 + ( 33 * (int) ( $days / 12053 ) );
        $days %= 12053;
        $jy += 4 * (int) ( $days / 1461 );
        $days %= 1461;
        if ( $days > 365 ) {
            $jy += (int) ( ( $days - 1 ) / 365 );
            $days = ( $days - 1 ) % 365;
        }
        if ( $days < 186 ) {
            $jm = 1 + (int) ( $days / 31 );
            $jd = 1 + ( $days % 31 );
        } else {
            $jm = 7 + (int) ( ( $days - 186 ) / 30 );
            $jd = 1 + ( ( $days - 186 ) % 30 );
        }
        return sprintf( '%04d/%02d/%02d', $jy, $jm, $jd );
    }

    private function get_date_label( $post_id, $date_format ) {
        $gregorian = get_the_date( 'Y-m-d', $post_id );
        if ( $date_format === 'jalali' ) {
            return $this->format_jalali_date( $gregorian );
        }
        return get_the_date( 'Y/m/d', $post_id );
    }

    private function is_new_post( $post_id, $days = 7 ) {
        $post_time = get_the_time( 'U', $post_id );
        return ( time() - $post_time ) <= ( $days * DAY_IN_SECONDS );
    }

    private function get_grid_classes( $style ) {
        if ( $style === 'bento' ) {
            return 'grid grid-cols-1 md:grid-cols-6 gap-6';
        }
        if ( $style === 'glass' ) {
            return 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6';
        }
        if ( $style === 'editorial' ) {
            return 'flex flex-col gap-6';
        }
        return 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6';
    }

    public function widget( $args, $instance ) {
        $instance = wp_parse_args( $instance, $this->get_defaults() );
        $categories = array_filter( array_map( 'absint', (array) $instance['categories'] ) );
        $posts_per_page = (int) $instance['posts_per_page'];
        $posts_per_page = min( 20, max( 1, $posts_per_page ) );
        $order_by = $instance['order_by'];
        $style = $instance['style'];
        $views_meta_key = $instance['views_meta_key'];
        $strapline = $instance['strapline'];

        $query_args = array(
            'post_type'           => 'post',
            'posts_per_page'      => $posts_per_page,
            'ignore_sticky_posts' => true,
            'no_found_rows'       => true,
        );

        if ( ! empty( $categories ) ) {
            $query_args['category__in'] = $categories;
        }

        if ( $order_by === 'date_asc' ) {
            $query_args['orderby'] = 'date';
            $query_args['order'] = 'ASC';
        } elseif ( $order_by === 'popularity' ) {
            $query_args['orderby'] = 'comment_count';
            $query_args['order'] = 'DESC';
        } elseif ( $order_by === 'views' ) {
            $query_args['orderby'] = 'meta_value_num';
            $query_args['meta_key'] = $views_meta_key;
            $query_args['order'] = 'DESC';
        } else {
            $query_args['orderby'] = 'date';
            $query_args['order'] = 'DESC';
        }

        $news_query = new WP_Query( $query_args );

        if ( ! $news_query->have_posts() ) {
            return;
        }

        echo $args['before_widget'];

        $show_date = ! empty( $instance['show_date'] );
        $date_format = $instance['date_format'];

        if ( ! empty( $instance['title'] ) || ! empty( $strapline ) ) {
            echo '<div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">';
            echo '<div>';
            if ( ! empty( $strapline ) ) {
                echo '<span class="text-copper font-bold mb-2 block text-sm flex items-center gap-2"><span class="w-8 h-[2px] bg-copper"></span> ' . esc_html( $strapline ) . '</span>';
            }
            if ( ! empty( $instance['title'] ) ) {
                echo '<h2 class="text-4xl font-black text-slate-900">' . esc_html( apply_filters( 'widget_title', $instance['title'] ) ) . '</h2>';
            }
            echo '</div>';
            echo '</div>';
        }

        $posts = $news_query->posts;

        if ( $style === 'frontpage' ) {
            $featured = ! empty( $posts ) ? $posts[0] : null;
            $side_posts = array_slice( $posts, 1, 3 );

            echo '<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">';

            if ( $featured ) {
                setup_postdata( $featured );
                $featured_id = $featured->ID;
                $featured_thumb = get_the_post_thumbnail_url( $featured_id, 'large' );
                $featured_excerpt = wp_trim_words( get_the_excerpt( $featured_id ), 28, '...' );
                $featured_date = $show_date ? $this->get_date_label( $featured_id, $date_format ) : '';

                echo '<article class="lg:col-span-2 group relative rounded-lg overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 h-[460px]">';
                echo '<a href="' . esc_url( get_permalink( $featured_id ) ) . '" class="absolute inset-0">';
                if ( $featured_thumb ) {
                    echo '<img src="' . esc_url( $featured_thumb ) . '" alt="' . esc_attr( get_the_title( $featured_id ) ) . '" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">';
                } else {
                    echo '<div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400">';
                    echo kermancopper_icon('image', 'w-10 h-10 opacity-60');
                    echo '</div>';
                }
                echo '<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>';
                echo '<div class="absolute bottom-0 left-0 right-0 p-8 md:p-12">';
                echo '<div class="flex items-center gap-4 mb-4 text-white/80 text-xs font-bold">';
                echo '<span class="bg-copper text-white px-3 py-1 rounded-full">ویژه</span>';
                if ( $show_date ) {
                    echo '<span>' . esc_html( $featured_date ) . '</span>';
                }
                echo '</div>';
                echo '<h3 class="font-black text-white text-2xl md:text-4xl leading-tight mb-4 group-hover:text-copper transition-colors">' . esc_html( get_the_title( $featured_id ) ) . '</h3>';
                echo '<p class="text-slate-200 text-sm md:text-base leading-relaxed line-clamp-2 mb-6 max-w-2xl opacity-90">' . esc_html( $featured_excerpt ) . '</p>';
                echo '<span class="inline-flex items-center gap-2 text-white font-bold border-b border-white/30 pb-1 group-hover:border-copper group-hover:text-copper transition-all">مطالعه کامل خبر ' . kermancopper_icon('arrow-left', 'w-4 h-4') . '</span>';
                echo '</div>';
                echo '</a>';
                echo '</article>';
                wp_reset_postdata();
            }

            echo '<div class="flex flex-col gap-6">';
            foreach ( $side_posts as $side_post ) {
                setup_postdata( $side_post );
                $side_id = $side_post->ID;
                $side_thumb = get_the_post_thumbnail_url( $side_id, 'medium' );
                $side_date = $show_date ? $this->get_date_label( $side_id, $date_format ) : '';

                echo '<article class="group bg-slate-50 rounded-lg p-4 flex gap-4 transition-all hover:bg-white hover:shadow-xl border border-slate-100">';
                echo '<a href="' . esc_url( get_permalink( $side_id ) ) . '" class="flex gap-4 w-full">';
                echo '<div class="w-28 h-28 sm:w-32 sm:h-32 rounded-lg overflow-hidden flex-shrink-0 relative">';
                if ( $side_thumb ) {
                    echo '<img src="' . esc_url( $side_thumb ) . '" alt="' . esc_attr( get_the_title( $side_id ) ) . '" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">';
                } else {
                    echo '<div class="w-full h-full bg-white flex items-center justify-center text-slate-300">';
                    echo kermancopper_icon('image', 'w-6 h-6') . '2222';
                    echo '</div>';
                }
                echo '</div>';
                echo '<div class="flex flex-col justify-center">';
                if ( $show_date ) {
                    echo '<div class="text-[10px] font-bold text-copper mb-2">' . esc_html( $side_date ) . '</div>';
                }
                echo '<h4 class="font-bold text-slate-800 text-sm sm:text-base leading-snug mb-2 group-hover:text-copper transition-colors line-clamp-2">' . esc_html( get_the_title( $side_id ) ) . '</h4>';
                echo '<span class="text-xs text-slate-400 mt-auto flex items-center gap-1 group-hover:text-copper transition-colors">بیشتر بخوانید ' . kermancopper_icon('chevron-left', 'w-3 h-3') . '</span>';
                echo '</div>';
                echo '</a>';
                echo '</article>';
            }
            wp_reset_postdata();
            echo '</div>';
            echo '</div>';
        } elseif ( $style === 'slider' ) {
            echo '<div class="relative">';
            echo '<div class="flex gap-6 overflow-x-auto snap-x snap-mandatory pb-4 -mx-4 px-4">';
            foreach ( $posts as $post ) {
                setup_postdata( $post );
                $post_id = $post->ID;
                $thumb = get_the_post_thumbnail_url( $post_id, 'large' );
                $excerpt = wp_trim_words( get_the_excerpt( $post_id ), 18, '...' );
                $date_label = $show_date ? $this->get_date_label( $post_id, $date_format ) : '';

                echo '<article class="group min-w-[260px] sm:min-w-[320px] lg:min-w-[360px] snap-start rounded-lg overflow-hidden border border-slate-100 bg-white shadow-sm hover:shadow-xl transition-all">';
                echo '<a href="' . esc_url( get_permalink( $post_id ) ) . '" class="block">';
                echo '<div class="relative h-48 overflow-hidden bg-slate-100">';
                if ( $thumb ) {
                    echo '<img src="' . esc_url( $thumb ) . '" alt="' . esc_attr( get_the_title( $post_id ) ) . '" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">';
                } else {
                    echo '<div class="w-full h-full flex items-center justify-center text-slate-400">';
                    echo kermancopper_icon('image', 'w-6 h-6 opacity-60');
                    echo '</div>';
                }
                echo '<div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/10 to-transparent opacity-70"></div>';
                if ( $show_date ) {
                    echo '<span class="absolute top-3 right-3 bg-white/90 text-slate-700 text-[10px] font-bold px-2 py-1 rounded-lg">' . esc_html( $date_label ) . '</span>';
                }
                echo '</div>';
                echo '<div class="p-5 flex flex-col gap-3">';
                echo '<h3 class="font-bold text-slate-800 text-sm sm:text-base leading-snug line-clamp-2 group-hover:text-copper transition-colors">' . esc_html( get_the_title( $post_id ) ) . '</h3>';
                echo '<p class="text-xs sm:text-sm text-slate-500 leading-relaxed line-clamp-2">' . esc_html( $excerpt ) . '</p>';
                echo '<span class="text-xs text-slate-400 flex items-center gap-1 group-hover:text-copper transition-colors">مشاهده خبر ' . kermancopper_icon('chevron-left', 'w-3 h-3') . '</span>';
                echo '</div>';
                echo '</a>';
                echo '</article>';
            }
            wp_reset_postdata();
            echo '</div>';
            echo '</div>';
        } elseif ( $style === 'editorial' ) {
            echo '<div class="flex flex-col gap-6">';
            foreach ( $posts as $index => $post ) {
                setup_postdata( $post );
                $post_id = $post->ID;
                $thumb = get_the_post_thumbnail_url( $post_id, 'large' );
                $excerpt = wp_trim_words( get_the_excerpt( $post_id ), 22, '...' );
                $date_label = $show_date ? $this->get_date_label( $post_id, $date_format ) : '';
                $number = str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT );

                echo '<article class="group bg-white border border-slate-100 rounded-lg p-4 sm:p-5 flex flex-col md:flex-row gap-5 hover:shadow-xl transition-all">';
                echo '<a href="' . esc_url( get_permalink( $post_id ) ) . '" class="md:w-56 w-full h-40 rounded-lg overflow-hidden bg-slate-100 flex-shrink-0">';
                if ( $thumb ) {
                    echo '<img src="' . esc_url( $thumb ) . '" alt="' . esc_attr( get_the_title( $post_id ) ) . '" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">';
                } else {
                    echo '<div class="w-full h-full flex items-center justify-center text-slate-400">';
                    echo kermancopper_icon('image', 'w-6 h-6 opacity-60');
                    echo '</div>';
                }
                echo '</a>';
                echo '<div class="flex-1 flex flex-col">';
                if ( $show_date ) {
                    echo '<div class="text-[11px] font-bold text-copper flex items-center gap-1 mb-2">';
                    echo kermancopper_icon('calendar', 'w-3 h-3');
                    echo '<span>' . esc_html( $date_label ) . '</span>';
                    echo '</div>';
                }
                echo '<h3 class="font-bold text-slate-900 text-base sm:text-lg leading-snug line-clamp-2 group-hover:text-copper transition-colors mb-2">' . esc_html( get_the_title( $post_id ) ) . '</h3>';
                echo '<p class="text-xs sm:text-sm text-slate-500 leading-relaxed line-clamp-2">' . esc_html( $excerpt ) . '</p>';
                echo '<span class="mt-auto inline-flex items-center gap-2 text-xs font-bold text-slate-400 group-hover:text-copper transition-colors">مشاهده خبر ' . kermancopper_icon('arrow-left', 'w-3 h-3') . '</span>';
                echo '</div>';
                echo '<div class="md:w-12 text-3xl font-black text-copper/20 flex justify-end">' . esc_html( $number ) . '</div>';
                echo '</article>';
            }
            wp_reset_postdata();
            echo '</div>';
        } else {
            echo '<div class="' . esc_attr( $this->get_grid_classes( $style ) ) . '">';
            foreach ( $posts as $index => $post ) {
                setup_postdata( $post );
                $post_id = $post->ID;
                $thumb = get_the_post_thumbnail_url( $post_id, 'large' );
                $excerpt = wp_trim_words( get_the_excerpt( $post_id ), 18, '...' );
                $date_label = $show_date ? $this->get_date_label( $post_id, $date_format ) : '';
                $wrapper_classes = 'group overflow-hidden rounded-lg border border-slate-100 bg-white transition-all duration-300';
                if ( $style === 'bento' ) {
                    if ( $index === 0 ) {
                        $wrapper_classes .= ' md:col-span-4 md:row-span-2 shadow-md hover:shadow-2xl';
                    } elseif ( $index === 1 || $index === 2 ) {
                        $wrapper_classes .= ' md:col-span-2 shadow-sm hover:shadow-xl';
                    } else {
                        $wrapper_classes .= ' md:col-span-3 shadow-sm hover:shadow-xl';
                    }
                } elseif ( $style === 'glass' ) {
                    $wrapper_classes .= ' bg-white/80 backdrop-blur border border-white/60 shadow-md hover:shadow-2xl';
                } else {
                    $wrapper_classes .= ' shadow-sm hover:shadow-xl';
                }

                echo '<article class="' . esc_attr( $wrapper_classes ) . '">';
                echo '<a href="' . esc_url( get_permalink( $post_id ) ) . '" class="block">';
                echo '<div class="relative h-48 overflow-hidden bg-slate-100">';
                if ( $thumb ) {
                    echo '<img src="' . esc_url( $thumb ) . '" alt="' . esc_attr( get_the_title( $post_id ) ) . '" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">';
                } else {
                    echo '<div class="w-full h-full flex items-center justify-center text-slate-400">';
                    echo kermancopper_icon('image', 'w-6 h-6 opacity-60');
                    echo '</div>';
                }
                if ( $style === 'glass' ) {
                    echo '<div class="absolute inset-0 bg-gradient-to-t from-white/50 via-transparent to-transparent"></div>';
                }
                echo '</div>';
                echo '<div class="p-5 flex flex-col gap-3">';
                if ( $show_date ) {
                    echo '<div class="text-[11px] font-bold text-copper flex items-center gap-1">';
                    echo kermancopper_icon('calendar', 'w-3 h-3');
                    echo '<span>' . esc_html( $date_label ) . '</span>';
                    echo '</div>';
                }
                echo '<h3 class="font-bold text-slate-800 text-sm sm:text-base leading-snug line-clamp-2 group-hover:text-copper transition-colors">' . esc_html( get_the_title( $post_id ) ) . '</h3>';
                echo '<p class="text-xs sm:text-sm text-slate-500 leading-relaxed line-clamp-2">' . esc_html( $excerpt ) . '</p>';
                echo '<span class="text-xs text-slate-400 flex items-center gap-1 group-hover:text-copper transition-colors">بیشتر بخوانید ' . kermancopper_icon('chevron-left', 'w-3 h-3') . '</span>';
                echo '</div>';
                echo '</a>';
                echo '</article>';
            }
            wp_reset_postdata();
            echo '</div>';
        }

        echo $args['after_widget'];
    }

    public function form( $instance ) {
        $instance = wp_parse_args( $instance, $this->get_defaults() );
        $title = $instance['title'];
        $categories = (array) $instance['categories'];
        $order_by = $instance['order_by'];
        $show_date = (bool) $instance['show_date'];
        $date_format = $instance['date_format'];
        $posts_per_page = (int) $instance['posts_per_page'];
        $style = $instance['style'];
        $views_meta_key = $instance['views_meta_key'];
        $strapline = $instance['strapline'];
        $all_categories = get_categories( array( 'hide_empty' => false ) );
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'عنوان:', 'kermancopper' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'strapline' ) ); ?>"><?php esc_html_e( 'روتیتر:', 'kermancopper' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'strapline' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'strapline' ) ); ?>" type="text" value="<?php echo esc_attr( $strapline ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'categories' ) ); ?>"><?php esc_html_e( 'انتخاب دسته‌بندی‌ها:', 'kermancopper' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'categories' ) ); ?>[]" multiple size="6">
                <?php foreach ( $all_categories as $cat ) : ?>
                    <option value="<?php echo esc_attr( $cat->term_id ); ?>" <?php echo in_array( $cat->term_id, $categories, true ) ? 'selected' : ''; ?>>
                        <?php echo esc_html( $cat->name ); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>"><?php esc_html_e( 'ترتیب نمایش:', 'kermancopper' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order_by' ) ); ?>">
                <option value="date_desc" <?php selected( $order_by, 'date_desc' ); ?>><?php esc_html_e( 'تاریخ (نزولی)', 'kermancopper' ); ?></option>
                <option value="date_asc" <?php selected( $order_by, 'date_asc' ); ?>><?php esc_html_e( 'تاریخ (صعودی)', 'kermancopper' ); ?></option>
                <option value="popularity" <?php selected( $order_by, 'popularity' ); ?>><?php esc_html_e( 'محبوبیت (تعداد دیدگاه)', 'kermancopper' ); ?></option>
                <option value="views" <?php selected( $order_by, 'views' ); ?>><?php esc_html_e( 'تعداد بازدید (متا)', 'kermancopper' ); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'views_meta_key' ) ); ?>"><?php esc_html_e( 'کلید متای بازدید:', 'kermancopper' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'views_meta_key' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'views_meta_key' ) ); ?>" type="text" value="<?php echo esc_attr( $views_meta_key ); ?>">
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" />
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php esc_html_e( 'نمایش تاریخ', 'kermancopper' ); ?></label>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'date_format' ) ); ?>"><?php esc_html_e( 'فرمت تاریخ:', 'kermancopper' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'date_format' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'date_format' ) ); ?>">
                <option value="gregorian" <?php selected( $date_format, 'gregorian' ); ?>><?php esc_html_e( 'میلادی', 'kermancopper' ); ?></option>
                <option value="jalali" <?php selected( $date_format, 'jalali' ); ?>><?php esc_html_e( 'شمسی', 'kermancopper' ); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'posts_per_page' ) ); ?>"><?php esc_html_e( 'تعداد پست‌ها (1 تا 20):', 'kermancopper' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'posts_per_page' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'posts_per_page' ) ); ?>" type="number" min="1" max="20" value="<?php echo esc_attr( $posts_per_page ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>"><?php esc_html_e( 'استایل نمایش:', 'kermancopper' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'style' ) ); ?>">
                <option value="frontpage" <?php selected( $style, 'frontpage' ); ?>><?php esc_html_e( 'ویژه صفحه اصلی', 'kermancopper' ); ?></option>
                <option value="slider" <?php selected( $style, 'slider' ); ?>><?php esc_html_e( 'اسلایدر افقی', 'kermancopper' ); ?></option>
                <option value="bento" <?php selected( $style, 'bento' ); ?>><?php esc_html_e( 'بنتو مدرن', 'kermancopper' ); ?></option>
                <option value="glass" <?php selected( $style, 'glass' ); ?>><?php esc_html_e( 'گلس مورفیک', 'kermancopper' ); ?></option>
                <option value="editorial" <?php selected( $style, 'editorial' ); ?>><?php esc_html_e( 'ادیتوریال مینیمال', 'kermancopper' ); ?></option>
            </select>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['strapline'] = ! empty( $new_instance['strapline'] ) ? sanitize_text_field( $new_instance['strapline'] ) : '';
        $instance['categories'] = ! empty( $new_instance['categories'] ) ? array_map( 'absint', (array) $new_instance['categories'] ) : array();
        $instance['order_by'] = ! empty( $new_instance['order_by'] ) ? sanitize_text_field( $new_instance['order_by'] ) : 'date_desc';
        $instance['show_date'] = ! empty( $new_instance['show_date'] ) ? 1 : 0;
        $instance['date_format'] = ! empty( $new_instance['date_format'] ) ? sanitize_text_field( $new_instance['date_format'] ) : 'gregorian';
        $instance['posts_per_page'] = ! empty( $new_instance['posts_per_page'] ) ? (int) $new_instance['posts_per_page'] : 6;
        $instance['style'] = ! empty( $new_instance['style'] ) ? sanitize_text_field( $new_instance['style'] ) : 'frontpage';
        $instance['views_meta_key'] = ! empty( $new_instance['views_meta_key'] ) ? sanitize_key( $new_instance['views_meta_key'] ) : 'post_views';
        return $instance;
    }
}
