<?php
if($pagename == "index") {
    $file = "content/blog.json";
    $fullView = false;
} else {
    $file = "../content/blog.json";
    $fullView = true;
}

if(file_exists($file) && filesize($file) > 0){
    $handle = fopen($file, "a+");
    $contents = fread($handle, filesize($file));
    $blogs = json_decode($contents);
    fclose($handle);
    
    
    foreach ($blogs as $blog){
            if($fullView == true && $blog->id == $pagename) { echo ''; } else { ?>
            <article class="post">
                <h3><a href="<?= $blog->link ?>"><?= $blog->title ?></a></h3>
                <p class="clearfix">posted by: <b><?= $blog->auteur ?></b> on <b><?= $blog->datum ?></b>, Tags: <a href="<?php echo $blog->taglink; ?>"><b><?= $blog->tags ?></b></a></p>
                <div class="clearfix blogtext postcontent">
                    <?php
                        $text = $blog->text;
                        $text = substr($text, 0, 340);
                        $text = substr($text, 0, strrpos($text, ' ')) . " ..."; 
                        echo(nl2br($text))
                    ?>
                </div>
            </article>
            <?php
        }
        
    }
} else {
    echo "Something went wrong...";
}
?>
