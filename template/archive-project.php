<?php

get_header();

$curentpage = get_query_var('paged');
$args = array(
    'post_type'      => 'project',
    'posts_per_page' => '-1',
    'publish_status' => 'published',
    'paged'          => $curentpage
);

?>
                   
<div class="container">
    <form action="/" method="get"  autocomplete="off">
        <input type="text" name="s" placeholder="Search Code..." id="keyword" class="input_search" >
        <select id="mySelection">
            <option value="">-- Select --</option>
            <option value="new">NEW</option>
            <option value="old">OLD</option>
            <option value="asc">ASC</option>
            <option value="desc">DESC</option>
        </select>
    </form>

    <?php $query = new WP_Query($args); ?>

    <div class="row">   
            <?php

            // LOOP for posts
            if($query->have_posts()) {
            ?>
                <div class="search_result" id="datafetch">
            <?php
                while ( $query->have_posts()){
                    $query->the_post();
            ?>
            
        <div style="width:350px;height:300px;border:2px solid black;margin:5px;display:inline-block"><center> 
                <h2> <a href=" <?php the_permalink(); ?> "> <?php the_title(); ?></a></h2>
                <a href=" <?php the_permalink(); ?> ">  <?php the_post_thumbnail();?> </a>
                <p><?php the_content(); ?></p></center>
        </div>

            <?php             
            }
            ?>

                <br>
        <div class="pagination">
            <?php
                echo paginate_links( array(
                'total' => $query->max_num_pages
                ) );
            }

            ?>
        </div>
        </div>
    </div>
</div>

<?php 

get_footer();

?>