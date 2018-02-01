<html>
    <head>
        <title>Raw2Table</title>
        <style>
            td,th {
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <form method="post">
            <textarea name="raw" rows="20" cols="100"></textarea><br/>
            <input type="submit">
        </form>

        <?php
            include "raw2table.php";
            if(isset($_POST['raw'])):
        ?>
        <table cellspacing="0" border="1">
            <tr>
                <th>Range</th>
                <th>Frekuensi</th>
                <th>Frekuensi Kumulatif</th>
            </tr>
            <?php
                $obj = new raw2table();
                $data = $obj->convert_data($_POST['raw']);
                $row = 0;
                foreach ($obj->get_freq_dist_table($data) as $item) :
            ?>
                <tr>
                    <td align="center"><?=$item['min']?> - <?=$item['max']?></td>
                    <td align="center"><?=$item['freq']?></td>
                    <td align="center">
                        <?php
                            $fk += $obj->get_freq_dist_table($data)[$row]['freq'];
                            echo $fk;
                            $row++;
                        ?>
                    </td>
                </tr>
            <?php
                endforeach;
            ?>
        </table>
        <?php
            echo "<br/>";
            echo "Total data : ".$obj->get_total_data($data)."<br/>";
            echo "Minimal data : ".$obj->get_min($data)."<br/>";
            echo "Maksimal data : ".$obj->get_max($data)."<br/>";
            echo "Rentang data : ".$obj->get_range($data)."<br/>";
            echo "Jumlah kelas : ".$obj->get_many_classes($data)."<br/>";
            echo "Panjang per-kelas : ".$obj->get_long_class($data)."<br/>";
            endif;
        ?>
    </body>
</html>