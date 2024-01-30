<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">

</head>
<style>
    .admin {
        display: flex;
        gap: 1rem;
    }

    .name p {
        font-weight: bold;
        color: grey;
    }
</style>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation active" style="">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">Bookify</span>
                    </a>
                </li>

                <li >
                    <a href="{{route('dashboard.index')}}">
                        <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Users</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('books.index')}}">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">Books</span>
                    </a>
                </li>

                <li class="active">
                    <a href="#">
                        <span class="icon">
                        <ion-icon name="checkmark-outline"></ion-icon>
                        </span>
                        <span class="title">Reserved Books</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('login')}}">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main active">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here" name="search" id="search">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="admin">
                    <div class="user">
                        <img src="{{asset('images/me.jpg')}}" alt="">
                    </div>
                    <div class="name">
                        <p>
                            Nabil CHABAB
                        </p>
                        <p>Admin</p>
                    </div>
                </div>
            </div>


            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">1,504</div>
                        <div class="cardName">Daily Views</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">800</div>
                        <div class="cardName">Total Students</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="people-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">284</div>
                        <div class="cardName">Comments</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">42</div>
                        <div class="cardName">Total Teachers</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="people-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Recent Users</h2>
                        <a href="add_students.php" class="btn">Create New</a>
                    </div>

                    <table id="userTable">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Profile</td>
                                <td>FullName</td>
                                <td>Email</td>
                                <td>Phone</td>
                                <td>Type</td>
                                <td>Actions</td>

                            </tr>
                        </thead>

                        <tbody id="userTableBody">
                            <tr>
                                <th>1</th>
                                <td>zertyui</td>
                                <td>zertyui</td>
                                <td>zertyui</td>
                                <td>zertyui</td>
                                <td>zertyui</td>
                                <td>
                                    <a href="#" style="color:black;font-size:20px;margin-right:20px"><ion-icon name="pencil-outline"></ion-icon></a>
                                    <a href="#" style="color:red;font-size:20px;"><ion-icon name="close-circle-outline"></ion-icon></a>
                                    </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- ================= New Customers ================ -->

            </div>

            <!-- ======================= Cards ================== -->
        </div>

    </div>

    <!-- =========== Scripts =========  -->
    <script src="{{asset('js/admin.js')}}"></script>






    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>