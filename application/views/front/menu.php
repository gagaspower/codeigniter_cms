<?php
// data main menu
$main_menu = $this->db->query('select * from mainmenu where aktif="Y" order by id_main asc');
             foreach ($main_menu->result() as $main) {
              // Query untuk mencari data sub menu
$sub_menu = $this->db->query('SELECT * FROM submenu, mainmenu  
                            WHERE submenu.id_main=mainmenu.id_main 
                            AND submenu.id_main="'.$main->id_main.'"');
// periksa apakah ada sub menu
if ($sub_menu->num_rows() > 0) {
// main menu dengan sub menu
echo "<li class='dropdown active'>
<a href='".base_url().$main->link."' class='dropdown-toggle' data-toggle='dropdown' >".$main->nama_menu."<b class='caret'></b></a>";
    // sub menu nya disini
    echo "<ul class='dropdown-menu'>";
    foreach ($sub_menu->result() as $sub){
        echo "<li><a href='".base_url().$sub->link_sub."'>".$sub->nama_sub."</a></li>";
            }
        echo"</ul></li>";
        } else {
        // main menu tanpa sub menu
        echo "<li><a href='".base_url().$main->link."'>".$main->nama_menu."</a></li>";
                }
            }
 ?>

