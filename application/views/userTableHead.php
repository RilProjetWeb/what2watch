    <button type="button" class="btn btn-success btn-lg"><a style="color: white;" href="http://localhost/What2Watch/index.php/User/createForm">Ajouter un utilisateur</a></button>
<div class="container">
        <div class="table-wrapper">			
            <table class="table table-bordered">
                <thead>
                    <tr style="text-align: center;">
                        <th <?php if (substr($_SERVER['PATH_INFO'], 18)=='id') { echo "style='background-color: yellow;'";} ?> >Id <?php if (substr($_SERVER['PATH_INFO'], 18)=='id'){ echo "<a href='ALL'>DESC</a>"; }else{ echo "<a href='id'>ASC</a>"; } ?></th>
                        <th <?php if (substr($_SERVER['PATH_INFO'], 18)=='pseudo') { echo "style='background-color: yellow;'";} ?> >Pseudo <?php if (substr($_SERVER['PATH_INFO'], 18)=='pseudo'){ echo "<a href='ALL'>DESC</a>"; }else{ echo "<a href='pseudo'>ASC</a>"; } ?></th>
                        <th <?php if (substr($_SERVER['PATH_INFO'], 18)=='name') { echo "style='background-color: yellow;'";} ?> >Nom <?php if (substr($_SERVER['PATH_INFO'], 18)=='name'){ echo "<a href='ALL'>DESC</a>"; }else{ echo "<a href='name'>ASC</a>"; } ?></th>
                        <th <?php if (substr($_SERVER['PATH_INFO'], 18)=='firstname') { echo "style='background-color: yellow;'";} ?> >Prénom <?php if (substr($_SERVER['PATH_INFO'], 18)=='firstname'){ echo "<a href='ALL'>DESC</a>"; }else{ echo "<a href='firstname'>ASC</a>"; } ?></th>
                        <th <?php if (substr($_SERVER['PATH_INFO'], 18)=='mail') { echo "style='background-color: yellow;'";} ?> >Mail <?php if (substr($_SERVER['PATH_INFO'], 18)=='mail'){ echo "<a href='ALL'>DESC</a>"; }else{ echo "<a href='mail'>ASC</a>"; } ?></th>
                        <th <?php if (substr($_SERVER['PATH_INFO'], 18)=='role') { echo "style='background-color: yellow;'";} ?> >Rôle <?php if (substr($_SERVER['PATH_INFO'], 18)=='role'){ echo "<a href='ALL'>DESC</a>"; }else{ echo "<a href='role'>ASC</a>"; } ?></th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>