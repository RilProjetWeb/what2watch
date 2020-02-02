<div class="container">
        <div class="table-wrapper">			
            <table class="table table-bordered">
                <thead>
                    <tr style="text-align: center;">
                        <th <?php if (substr($_SERVER['PATH_INFO'], 18)=='id') { echo "style='background-color: yellow;'";} ?> >Id <?php if (substr($_SERVER['PATH_INFO'], 18)=='id'){ echo "<a href='ALL'>-</a>"; }else{ echo "<a href='id'>+</a>"; } ?></th>
                        <th <?php if (substr($_SERVER['PATH_INFO'], 18)=='pseudo') { echo "style='background-color: yellow;'";} ?> >Pseudo <?php if (substr($_SERVER['PATH_INFO'], 18)=='pseudo'){ echo "<a href='ALL'>-</a>"; }else{ echo "<a href='pseudo'>+</a>"; } ?></th>
                        <th <?php if (substr($_SERVER['PATH_INFO'], 18)=='name') { echo "style='background-color: yellow;'";} ?> >Nom <?php if (substr($_SERVER['PATH_INFO'], 18)=='name'){ echo "<a href='ALL'>-</a>"; }else{ echo "<a href='name'>+</a>"; } ?></th>
                        <th <?php if (substr($_SERVER['PATH_INFO'], 18)=='firstname') { echo "style='background-color: yellow;'";} ?> >Prénom <?php if (substr($_SERVER['PATH_INFO'], 18)=='firstname'){ echo "<a href='ALL'>-</a>"; }else{ echo "<a href='firstname'>+</a>"; } ?></th>
                        <th <?php if (substr($_SERVER['PATH_INFO'], 18)=='mail') { echo "style='background-color: yellow;'";} ?> >Mail <?php if (substr($_SERVER['PATH_INFO'], 18)=='mail'){ echo "<a href='ALL'>-</a>"; }else{ echo "<a href='mail'>+</a>"; } ?></th>
                        <th <?php if (substr($_SERVER['PATH_INFO'], 18)=='role') { echo "style='background-color: yellow;'";} ?> >Rôle <?php if (substr($_SERVER['PATH_INFO'], 18)=='role'){ echo "<a href='ALL'>-</a>"; }else{ echo "<a href='role'>+</a>"; } ?></th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>