<?php get_header(); ?>

<main class="main" role="main">

    <?php while (have_posts()) : the_post(); ?>

        <div class="content">
            <?php the_content(); ?>
        </div>

    <?php endwhile; ?>

    </div>
</main>

<?php get_footer(); ?>