<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Registration Page</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="main">
<div class="wrap">
    <div class="header">
    </div>

    <div align="center">
        <h1>My Product List Page | <?php echo $userName; ?> <a href='../login/index.php?action=logout' class="log-out">(logout)</a>
        </h1><br>
        <?php if (!empty($_POST) && isset($imageIncorrectFlag)) { ?>
            <div align="center">
                <form class="vertical-form-bottom">
                    <input id="error" type="hidden" readonly><label for="error">Image you submitted is incorrect. Only
                        png, bmp, jpg and gif files not larger than 3 MB can be used.</label>
                </form>
            </div>
        <?php } ?>

        <form enctype="multipart/form-data" class="product-add-form" method="post" action="../myPage/">
            <input type="hidden" name="MAX_FILE_SIZE" value="3145728">
            <input name="productPicture" type="file">
            <input type="text" name="productName" placeholder="Product Name" autofocus required maxlength="254">
            <input type="text" style="width: 177px" width="300" name="productCategoriesString" placeholder="Categories (use , ; delimiters)" required
                   maxlength="1000">
            <input type="hidden" name="newUserProductSubmitted" value="true">
            <input type="submit" value="Add">
        </form>


        <?php if (!is_null($userProducts[0])) { ?>

        <table class="products-table">


            <?php foreach ($userProducts as $uP): ?>

                <tr>
                    <!-- if Edit button has been clicked we need to open edit-form for that specific product line-->
                    <?php if (!empty($_POST['editUserProductFlag']) && $_POST['line_id'] == $uP->line_id) { ?>
                        <form enctype="multipart/form-data" class="product-add-form" method="post" action="../myPage/">
                            <th width="50">
                                <div class="hide-upload-btn-div">
                                    <div><img src="../../media/products/upload-32.png"></div>
                                    <input type="hidden" name="initialProductPictureName"
                                           value="<?= escapeSpecialCharactersHTML($uP->product_img_name) ?>">
                                    <input class="hide-upload-button-input" type="file" name="productPicture" id="file"
                                           size="1">
                                </div>
                                <!--<input name="productPicture" type="file"></th>-->
                            <th width="200"><input type="text" name="productName"
                                                   value="<?= escapeSpecialCharactersHTML($uP->product_name) ?>"
                                                   placeholder="Product Name" autofocus required maxlength="254"></th>
                            <th width="300"><input type="text" size="38" name="productCategoriesString"
                                                   value="<?php if (!is_null($uP->category_name1)) { ?><?= escapeSpecialCharactersHTML($uP->category_name1) ?><?php }
                                                   if (!is_null($uP->category_name2)) { ?>, <?= escapeSpecialCharactersHTML($uP->category_name2) ?><?php }
                                                   if (!is_null($uP->category_name3)) { ?>, <?= escapeSpecialCharactersHTML($uP->category_name3) ?><?php }
                                                   if (!is_null($uP->category_name3)) { ?>, <?= escapeSpecialCharactersHTML($uP->category_name4) ?><?php }
                                                   if (!is_null($uP->category_name3)) { ?>, <?= escapeSpecialCharactersHTML($uP->category_name5) ?><?php } ?>"
                                                   placeholder="Product Categories"
                                                   required maxlength="1000">
                                <input type="hidden" name="updateUserProductString" value="true"></th>
                            <input type="hidden" name="line_id" value="<?= $uP->line_id ?>">

                            <th width="66" align="right"><input TYPE="image" SRC="../../media/products/save-32.png"
                                                                HEIGHT="24"
                                                                WIDTH="24" BORDER="0" ALT="Save"></th>
                        </form>
                        <th width="32" align="center">
                            <form action="../myPage/" method="post">
                                <input type="hidden" name="cancelEditModeFlag" value="true">
                                <input TYPE="image" SRC="../../media/products/cancel-32.png" HEIGHT="24" WIDTH="24"
                                       BORDER="0" ALT="Cancel">
                            </form>
                        </th>

                        <!-- if Edit button was NOT clicked we need to open regular product list-->
                    <?php } else { ?>

                        <th width="50"><?php if (is_null($uP->product_img_name)) { ?><img
                                src="../../media/products/shopping-cart-32.png"><?php } else { ?><a
                                href="../uploads/<?= $userId ?>/original/<?= $uP->product_img_name ?>" target="_blank">
                                <img
                                    src="../uploads/<?= $userId ?>/cropped/<?= $uP->product_img_name ?>"></a><?php } ?>
                        </th>
                        <th width="200"><?= htmlspecialchars(ltrim(rtrim($uP->product_name))) ?></th>
                        <th width="300"><?php if (!is_null($uP->category_name1)) { ?><?= escapeSpecialCharactersHTML($uP->category_name1) ?><?php }
                            if (!is_null($uP->category_name2)) { ?>, <?= escapeSpecialCharactersHTML($uP->category_name2) ?><?php }
                            if (!is_null($uP->category_name3)) { ?>, <?= escapeSpecialCharactersHTML($uP->category_name3) ?><?php }
                            if (!is_null($uP->category_name3)) { ?>, <?= escapeSpecialCharactersHTML($uP->category_name4) ?><?php }
                            if (!is_null($uP->category_name3)) { ?>, <?= escapeSpecialCharactersHTML($uP->category_name5) ?><?php } ?></th>
                        <th width="66" align="right">
                            <form action="../myPage/" class="product-btn-form" method="post">
                                <input type="hidden" name="line_id" value="<?= $uP->line_id ?>">
                                <input type="hidden" name="product_id" value="<?= $uP->product_id ?>">
                                <input type="hidden" name="from_date" value="<?= $uP->from_date ?>">
                                <input type="hidden" name="editUserProductFlag" value="true">
                                <input TYPE="image" SRC="../../media/products/edit-32.png" HEIGHT="24" WIDTH="24"
                                       BORDER="0" ALT="Edit">
                            </form>
                        </th>

                        <th width="32" align="right">
                            <form action="../myPage/" method="post">
                                <input type="hidden" name="line_id" value="<?= $uP->line_id ?>">
                                <input type="hidden" name="product_id" value="<?= $uP->product_id ?>">
                                <input type="hidden" name="from_date" value="<?= $uP->from_date ?>">
                                <input type="hidden" name="deleteUserProduct" value="true">
                                <input TYPE="image" SRC="../../media/products/garbage-32.png" HEIGHT="24" WIDTH="24"
                                       BORDER="0" ALT="Delete">

                            </form>

                        </th>


                    <?php } ?>

                </tr>


            <?php endforeach;
            } else { ?>
                <br>You do not have products in your cart yet.
            <?php } ?>
        </table>

    </div>


</div>
<footer>
    Personal Info / 2016
</footer>
</body>

</html>