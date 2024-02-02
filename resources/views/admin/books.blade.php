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
        justify-content: center;
        align-items: center;
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

                <li class="active">
                    <a href="books.php">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">Books</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('reservations.index')}}">
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
                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}">
                                {{ __('Login') }}
                            </a>
                        @endif
                    @else
                        <div class="user">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();"><img
                                    src="{{ asset('storage/' . Auth::user()->profile) }}" alt=""></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                        <div class="name">
                            <p>
                                {{ Auth::user()->name }}
                            </p>

                        </div>
                    @endguest


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
                        <a href="{{route('books.create')}}" class="btn">Create New</a>
                    </div>

                    <table id="userTable">
                        <thead>
                            
                            <tr>
                                <td>ID</td>
                                <td>Cover</td>
                                <td>Title</td>
                                <td>Author</td>
                                <td>Category</td>
                                <td>Description</td>
                                <td>Publication_Year</td>
                                <td>Available_Copies</td>
                                <td>Total_Copies</td>
                                <td>Actions</td>

                            </tr>
                        </thead>

                        <tbody id="userTableBody">
                            @foreach ($books as $book)
                                
                            <tr>
                                <th> {{$book->id}} </th>
                                <td> <img src="{{asset('storage/'.$book->cover)}}" alt="" srcset="" style="width: 60px;border-radius:10px"> </td>
                                <td> {{$book->title}} </td>
                                <td> {{$book->author}} </td>
                                <td> {{$book->genre}} </td>
                                <td> {{$book->description}} </td>
                                <td> {{$book->publication_year}} </td>
                                <td> {{$book->total_copies}} </td>
                                <td> {{$book->available_copies}} </td>
                                <td style="display: flex;align-items:center;justify-content:center">
                                    <a href="{{ route('books.edit', ['book' => $book->id]) }}" style="color:black;font-size:20px;margin-right:20px">
                                        <ion-icon name="pencil-outline"></ion-icon>
                                    </a>
                                    <form action="{{ route('books.destroy', ['book' => $book->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="color:red;font-size:20px;background-color:transparent;border:none;cursor:pointer">
                                            <ion-icon name="close-circle-outline"></ion-icon>
                                        </button>
                                    </form>
                                            
                                </td>
                            </tr>
                            @endforeach
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


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    @if (session('status'))
    <script>
        setTimeout(function() {
            Swal.fire({
                title: 'Success',
                text: '{{ session('status') }}',
                icon: 'success',
                confirmButtonClass: 'btn btn-success', // Custom class for the "OK" button
                confirmButtonText: 'Cancel',
                confirmButtonColor: 'rgb(102, 102, 245)',
                 // Custom text for the "OK" button
            });
        }, {{ session('delay', 0) }});
    </script>
    @endif



    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>