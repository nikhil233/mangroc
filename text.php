<?php
session_start();
echo '<pre>';
print_r($_SESSION['cart']);
?>
<select id="qty<?php echo $product_row['id']?>">
                                            <option value="1">1</option>
                                                <?php
                                                
                                                for($i=2;$i<=10;$i++){
                                                    echo "<option>$i</option>";
                                                }
    ?>
</select>
<input type="number"  name="qty[<?php echo $key?>][]" value="<?php echo $list['qty']?>" id="qty<?php echo $key?>" />

<select  onchange="update_cart('<?php echo $key?>','load')"  id="qty<?php echo $key?>" name="qty[<?php echo $key?>][]">
                                            <option  value="<?php echo $list['qty']?>"><?php echo $list['qty']?></option>
                                                <?php
                                                
                                                for($i=1;$i<=10;$i++){
                                                    echo "<option>$i</option>";
                                                }
                                                    ?>
                                                </select>