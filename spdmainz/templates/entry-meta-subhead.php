<?php
/**
 * Meta Sub Head
 *
 * @package Virtue Theme
 */

?>
<div class="subhead">
        <?php
        do_action( 'virtue_before_post_meta_subhead' );
        if ( '1' === virtue_premium_get_option( 'hide_author' ) ) {
                $authorbytext = virtue_premium_get_option( 'post_by_text', __( 'by', 'virtue' ) );
                ?>
                <span class="postauthortop author vcard">
                        <i class="icon-user2"></i>
                        <?php echo esc_html( $authorbytext ) . ' '; ?>
                        <span itemprop="author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="fn" rel="author"><?php echo esc_html( get_the_author() ); ?></a></span>
                        <span class="virtue-meta-divider post-author-divider"> | </span>
                </span>
                <?php
        }
        if ( '1' === virtue_premium_get_option( 'hide_postedin' ) && has_category() ) {
                $incattext = virtue_premium_get_option( 'post_incat_text', __( 'posted in:', 'virtue' ) );
                ?>
                <span class="postedintop">
                        <i class="icon-drawer"></i>
                        <?php
                        echo esc_html( $incattext ) . ' ';
                        the_category( ', ' );
                        ?>
                </span>
                <span class="virtue-meta-divider post-category-divider kad-hidepostedin"> | </span>
                <?php
        }
        if ( '1' === virtue_premium_get_option( 'hide_commenticon' ) ) {
                ?>
                <span class="postcommentscount">
                        <a href="<?php the_permalink(); ?>#virtue_comments">
                                <i class="icon-bubbles"></i>
                                <?php comments_number( '0', '1', '%' ); ?>
                        </a>
                </span>
                <?php
        }
        // Insert Datei
        if ( ( 'post' === get_post_type() && '1' === virtue_premium_get_option( 'hide_postdate' ) ) || ( 'post' !== get_post_type() && '1' === virtue_premium_get_option( 'custom_post_show_postdate' ) ) ) {
                ?>
                <span>
                    <meta itemprop="datePublished" content="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>">
                    <?php echo esc_html( get_the_date( 'j. F Y' ) ); ?>
                </span>
                <?php
        }
        do_action( 'virtue_after_post_meta_subhead' );
        ?>
</div>