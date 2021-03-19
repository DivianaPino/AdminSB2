<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Productos - Tables</title>

    <!-- Custom fonts for this template -->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('includes.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('includes.nav')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Inventario</h1>
                    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">PRODUCTOS
                                <button type="button" class="ml-4 btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#demoModal" data-whatever="@mdo">Nuevo Proyecto</button>
                            </h6>
                        </div>
                        <div class="card-body text-center">
                            <div class="table-responsive border-bottom-primary">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Descripción</th>
                                            <th>Precio</th>
                                            <th>Imagen</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$product->nombre}}</td>
                                <td>{{$product->cantidad}}</td>
                                <td>{{$product->description}}</td>
                                <td>{{$product->precio}}</td>
                                <td>
                                    <img src="{{asset('images/producto/'.$product->featured)}}"
                                        class="img-fluid img-rounded" width="120px" alt="{{$product->title}}">
                                </td>
                                <td>
                                <!-- EDITAR -->
                                <a href="{{route('producto.edit', $product->id)}}" class="btn btn-warning btn-xs">Editar</a>
                                <!-- ELIMINAR -->
                                <form action="{{route('producto.delete' , $product->id)}}" method="POST">
                                    {{ csrf_field() }}
                                    <hr>
                                    <!--  Token para la seguridad de nuestra pagina (solución error 419) -->
                                    <input type="hidden" name="_method" value="delete" />
                                    <button class="btn btn-danger  btn-xs">Eliminar</button>
                                </form>
  
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- /.container-fluid -->

                    </div>
                    <!-- End of Main Content -->

                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy; Your Website 2021</span>
                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->

                </div>
                <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="#">Logout</a>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <!--Content-->
                    <div class="modal-content form-elegant border-bottom-primary border-lg border-bottom-width:50px">
                        <!--Header-->
                        <div class="modal-header text-center">
                            <h3 class="modal-title w-100 dark-grey-text font-weight-bold my-3" id="myModalLabel">
                                <strong>PRODUCTO</strong>
                                <img class="img-fluid" src="{{asset('/img/utiles.png')}}" style="width:150px"
                                    alt="utiles">
                            </h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('producto.store')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <!--Body-->
                            <div class="modal-body mx-4">
                                <!--Body-->
                                <div class="md-form mb-5">
                                    <label data-error="wrong" data-success="right" for="nombre">Nombre</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control validate">
                                </div>

                                <div class="md-form pb-3">
                                    <label data-error="wrong" data-success="right" for="cantidad">Cantidad</label>
                                    <input type="number" name="cantidad" id="cantidad" class="form-control validate">
                                </div>

                                <div class="md-form pb-3">
                                    <label data-error="wrong" data-success="right" for="description">Descripción</label>
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                </div>

                                <div class="md-form pb-3">
                                    <label data-error="wrong" data-success="right" for="precio">Precio</label>
                                    <input type="number" name="precio" id="precio" class="form-control validate">
                                </div>
                        
                                <div class="md-form pb-3">
                                    <label data-error="wrong" data-success="right" for="imagen">Imagen</label>
                                    <input type="file" id="imagen" name="imagen" class="form-control validate">

                                </div>

                                <div class="text-center mb-3">
                                    <button type="submit"
                                        class="btn btn-primary btn-block btn-rounded z-depth-1a">Crear</button>
                                </div>
                        </form>
                    </div>

                </div>
                <!--/.Content-->
            </div>
        </div>
        <!-- Modal -->

        <!-- <div class="text-center">
            <a href="" class="btn btn-default btn-rounded" data-toggle="modal" data-target="#elegantModalForm">Launch
                modal Login Form</a>
        </div> -->

        <!-- Bootstrap core JavaScript-->
        <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

</body>

</html>