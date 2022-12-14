<!-- Header -->
<?php include("common/header.php");?>
<!-- Header -->
<!-- Main Content -->
<main class="main_content">
    <!-- Side Navbar Links -->
    <?php include("common/sidebar.php");?>
    <!-- Side Navbar Links -->

    <!-- Page Content -->
    <section class="content_wrapper">
        <!-- Page Details Title -->
        <div class="page_details">
            <div>
                <a href="index.php" class="go_home"><small>Home</small></a>
                <small>/</small>
                <small>Pending Order</small>
            </div>
        </div>

        <!-- Page Main Content -->
        <section class="page_main_content">
            <div class="main_content_container">
                <!-- Table -->
                <div class="table_content_wrapper">
                <div style="display:flex; justify-content: space-between;" class="page_title">
                      <div>
                            <h3>Pending Order</h3> 
                        </div>
                        <div>
                        
                      </div>                    
                    </div>
                    <header class="table_header">
                        <div class="table_header_left">
                           
                        </div>

                        <form action="" method="POST">
                            <div class="table_header_right">
                                <input type="search" name="src_text" placeholder="Search Only Order No" />
                                <input style="cursor:pointer;" type="submit" name="search" class="btn" placeholder="Search" />
                            </div>
                        </form>
                    </header>
                    <div class="table_parent">
                    <table class="table">
                                <thead>
                                    <tr>
                                        <th class="table_th"><div class="table_th_div"><span>Sl.</span></div></th>
                                        <th class="table_th"><div class="table_th_div"><span>Image</span></div></th>
                                        <th class="table_th"><div class="table_th_div"><span>Name</span></div></th>
                                        <th class="table_th"><div class="table_th_div"><span>Email</span></div></th>
                                        <th class="table_th"><div class="table_th_div"><span>Order_id</span></div></th>
                                        <th class="table_th"><div class="table_th_div"><span>Price</span></div></th>
                                        <th class="table_th"><div class="table_th_div"><span>Date</span></div></th>
                                        <th class="table_th"><div class="table_th_div"><span>status</span></div></th>
                                        <th class="table_th"><div class="table_th_div"><span>Action</span></div></th>
                                    </tr>
                                </thead>
                                <tbody id="customers_wrapper" class="text-sm">
                                <?php
                                if(isset($_POST['search'])){
                                    $src_text = trim($_POST['src_text']);
                                    $sql = "SELECT * FROM tmp_product WHERE order_no = '$src_text' AND status='Pending' AND admin_id=$id";
                                    $search_query = mysqli_query($conn,$sql);
                                 }
                                 if(isset($search_query)){
                                    $i = 0;
                                    while($row = mysqli_fetch_assoc($search_query)){$i++; 
                                   $customer =  $row['customer_id'];
                                   $order_no =  $row['order_no'];
                                   $cusomer_info = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM customer WHERE id='$customer'"));
                                   $total_total = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(total) AS totalsum FROM tmp_product WHERE order_no='$order_no'"));
                                   
                                 ?>
                                    <tr>
                                        <td class="p-3 border whitespace-nowrap"><div class="text-center"><?php echo $i?></div></td>
                                        <td class="p-3 border whitespace-nowrap"><div class="text-center"><img class="row_img" src="upload/<?php echo $cusomer_info['file']?>"></div></td>
                                        <td class="p-3 border whitespace-nowrap"><div class="text-center"><?php echo $cusomer_info['name']?></div></td>
                                        <td class="p-3 border whitespace-nowrap"><div class="text-center"><?php echo $cusomer_info['email']?></div></td>
                                        <td class="p-3 border whitespace-nowrap"><div class="text-center"><?php echo $row['order_no']?></div></td>
                                        <td class="p-3 border whitespace-nowrap"><div class="text-center"><?php echo $total_total['totalsum'];?></div></td>
                                        <td class="p-3 border whitespace-nowrap"><div class="text-center"><?php $numberofsecs = $row['time'];echo $createdate = date('d-m-y',$numberofsecs);?></div></td>
                                        <td class="p-3 border whitespace-nowrap"><div class="text-center"><?php echo $row['status']?></div></td>                                        
                                        <td class="p-3 border whitespace-nowrap">
                                            <div class="w-full flex_center gap-1">
                                                <a class="btn table_edit_btn" href="pos-edit.php?order=<?php echo $row['order_no']?>&&customer=<?php echo $row['customer_id']?>">Edit</a>
                                                <a class="btn table_edit_btn" href="delete.php?src=pending&&order=<?php echo $row['order_no']?>">Delete</a>
                                                <a class="btn table_edit_btn" href="pos-invoice.php?order=<?php echo $row['order_no']?>&&customer=<?php echo $row['customer_id']?>">Invoice</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php }}else{
                                    // ------------                                
                                $showRecordPerPage = 8;
                                if(isset($_GET['page']) && !empty($_GET['page'])){
                                    $currentPage = $_GET['page'];
                                }else{
                                    $currentPage = 1;
                                }
                                $startFrom = ($currentPage * $showRecordPerPage) - $showRecordPerPage;
                                $totalEmpSQL = "SELECT * FROM tmp_product WHERE status='Pending'AND admin_id=$id ORDER BY id DESC";
                                $allEmpResult = mysqli_query($conn, $totalEmpSQL);
                                $totalEmployee = mysqli_num_rows($allEmpResult);
                                $lastPage = ceil($totalEmployee/$showRecordPerPage);
                                $firstPage = 1;
                                $nextPage = $currentPage + 1;
                                $previousPage = $currentPage - 1;
                                
                                $empSQL = "SELECT * FROM tmp_product WHERE status='Pending'AND admin_id=$id ORDER BY id DESC LIMIT $startFrom, $showRecordPerPage";
                                $query = mysqli_query($conn, $empSQL);
                                $i = 0;
                                while($row = mysqli_fetch_assoc($query)){ $i++;
                                   $customer =  $row['customer_id'];
                                   $order_no =  $row['order_no'];
                                   $cusomer_info = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM customer WHERE id='$customer'"));
                                   $total_total = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(total) AS totalsum FROM tmp_product WHERE order_no='$order_no'"));
                                   
                                 ?>
                                    <tr>
                                        <td class="p-3 border whitespace-nowrap"><div class="text-center"><?php echo $i?></div></td>
                                        <td class="p-3 border whitespace-nowrap"><div class="text-center"><img class="row_img" src="upload/<?php echo $cusomer_info['file']?>"></div></td>
                                        <td class="p-3 border whitespace-nowrap"><div class="text-center"><?php echo $cusomer_info['name']?></div></td>
                                        <td class="p-3 border whitespace-nowrap"><div class="text-center"><?php echo $cusomer_info['email']?></div></td>
                                        <td class="p-3 border whitespace-nowrap"><div class="text-center"><?php echo $row['order_no']?></div></td>
                                        <td class="p-3 border whitespace-nowrap"><div class="text-center"><?php echo $total_total['totalsum'];?></div></td>
                                        <td class="p-3 border whitespace-nowrap"><div class="text-center"><?php $numberofsecs = $row['time'];echo $createdate = date('d-m-y',$numberofsecs);?></div></td>
                                        <td class="p-3 border whitespace-nowrap"><div class="text-center"><?php echo $row['status']?></div></td>                                        
                                        <td class="p-3 border whitespace-nowrap">
                                            <div class="w-full flex_center gap-1">
                                                <a class="btn table_edit_btn" href="pos-edit.php?order=<?php echo $row['order_no']?>&&customer=<?php echo $row['customer_id']?>">Edit</a>
                                                <a class="btn table_edit_btn" href="delete.php?src=pending&&order=<?php echo $row['order_no']?>">Delete</a>
                                                <a class="btn table_edit_btn" href="pos-invoice.php?order=<?php echo $row['order_no']?>&&customer=<?php echo $row['customer_id']?>&&status=Pending">Invoice</a>
                                            </div>
                                        </td>
                                    </tr>
                              <?php  } ?>
                            </table>
                        </div>
                            <!-- -------------pagination---------------- -->
                        <br>
                        <div class="w-full" style="display: flex; justify-content: space-between;">

                            <nav aria-label="Page navigation">
                                <ul class="pagination_buttons">

                                    <?php if($currentPage >= 2) { ?>
                                    <li class="pagination"><a class="page-link"
                                            href="?page=<?php echo $previousPage ?>">Previws</a>
                                    </li>
                                    <?php } ?>
                                    <?php if($currentPage != $firstPage) { ?>
                                    <li class="pagination">
                                        <a class="page-link" href="?page=<?php echo $firstPage ?>" >
                                            <span class="page-link" aria-hidden="true">1</span>
                                        </a>
                                    </li>
                                    <?php } ?>

                                    <li class="pagination active"><a class="page-link active"
                                            href="?page=<?php echo $currentPage ?>"><?php echo $currentPage ?></a></li>

                                     <?php if($currentPage < $lastPage) { ?>
                                    <li class="pagination "><a class="page-link"
                                            href="?page=<?php echo $currentPage+1 ?>"><?php echo $currentPage+1 ?></a></li>
                                      <?php } ?>   
                                      
                                      <?php if($currentPage < $lastPage) { ?>
                                    <li class="pagination "><a class="page-link"
                                            href="?page=<?php echo $currentPage+1+1 ?>"><?php echo $currentPage+1+1 ?></a></li>
                                      <?php } ?>   

                                            <?php if($currentPage < $lastPage) { ?>     
                                    <li class="pagination "><a class="page-link"
                                            href="?page=<?php echo $currentPage+1+1+1 ?>"><?php echo $currentPage+1+1+1 ?></a></li>
                                            <?php } ?>   

                                    <?php if($currentPage < $lastPage) { ?>
                                    <li class="pagination"><a class="page-link"
                                            href="?page=<?php echo $nextPage ?>"><?php //echo $nextPage  ?>Next</a></li>
                                    <?php } ?>

                                    <li class="pagination">
                                        <a class="page-link" href="?page=<?php echo $lastPage ?>" aria-label="Next">
                                            <span aria-hidden="true">Last</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <div class="pagination_buttons">Page <?php echo $currentPage ?> of <?php echo $lastPage ?></div>
                        </div>
                        <?php } ?>
                    <!-- -------------pagination---------------- -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!-- Page Content -->
</main>
<!-- Side Navbar Links -->
<?php include("common/footer.php");?>
<!-- Side Navbar Links -->
<?php if (isset($_GET['msg'])) { ?><div id="munna" data-text="<?php echo $_GET['msg']; ?>"></div><?php } ?>
