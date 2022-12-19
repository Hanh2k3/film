@extends('admin.layouts.master')
@section('link-style')
    <link rel="stylesheet" href="{{ asset('admin/template/css/dashboard.css') }}">
@endsection
@section('content')
        <div class="row g_container ms-0 me-0">
            <h2 class="g_title">SỬA THÔNG TIN PHIM</h2>
            <!--/ Total Revenue -->
            <div class="col-12 order-1 order-md-1 p-0">
                <div class="row col-12 d-flex m-0">
                    <div class="col-12 col-md-4 mb-4">
                        <div class="card m-0">
                            <div class="card-body">
                                <div class="card-title">
                                    <h5 class="text-nowrap mb-2 text-secondary">Người dùng</h5>
                                </div>
                                <div class="mt-0 text-center">
                                    <h4 class="mb-0">{{ sizeof($user_data) }}</h4>
                                    <p class="text-center mb-3" style="font-size: 12px">người dùng</p>
                                </div>
                                <div class="mt-3">
                                    <p class="m-0 fw-semibold text-secondary text-center">Truy cập hôm nay: <span
                                            class="{{ ($user_today !== 0) ? 'text-success' : 'text-danger'}}">{{ $user_today }} người</span></p>
                                    <p class="m-0 fw-semibold text-secondary text-center">Truy cập tháng này: <span
                                            class="{{ ($user_month !== 0) ? 'text-success' : 'text-danger'}}">{{ $user_month }} người</span></p>
                                    <p class="m-0 fw-semibold text-secondary text-center">Truy cập năm nay: <span
                                            class="{{ ($user_year !== 0) ? 'text-success' : 'text-danger'}}">{{ $user_year }} người</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h5 class="text-nowrap mb-2 text-secondary">Tổng phim</h5>
                                </div>
                                <h4 class="card-title text-nowrap mb-0 text-center">{{ sizeof($film_data) }}</h4>
                                <p class="text-center mb-3" style="font-size: 12px">bộ phim</p>
                                @php
                                    $film_episode_full = 0;
                                    foreach ($film_data as $film) {
                                        $film->aired_episodes !== $film->episodes_quantity && $film_episode_full++;
                                    }
                                @endphp
                                <p class="m-0 fw-semibold text-center text-secondary">Đã chiếu đủ: <span class="text-success">{{ sizeof($film_data) - $film_episode_full }} bộ</span></p>
                                <p class="m-0 fw-semibold text-center text-secondary">Chưa chiếu đủ: <span class="text-warning">{{ $film_episode_full }} bộ</span></p>
                                <small class="d-block text-center text-decoration-underline"><a
                                        class="fw-semibold text-dark" href="/admin/film">chi tiết</a></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h5 class="text-nowrap mb-2 text-secondary">Tổng lượt xem</h5>
                                </div>                                
                                @php
                                    $film_view_total = 0;
                                    foreach ($film_data as $film) {
                                        $film_view_total += $film->view;
                                    }
                                @endphp
                                <h4 class="card-title text-nowrap mb-0 text-center ">{{ $film_view_total }}</h4>
                                <p class="text-center mb-3" style="font-size: 12px">lượt xem</p>
                                <p class="m-0 fw-semibold text-center text-secondary">Bộ xem nhiều nhất</p>
                                <p class="m-0 fw-semibold text-center text-success">ID: {{ $film_data[0]->film_id }} | Tên: {{ $film_data[0]->film_name }} | L.xem: {{ $film_data[0]->view }}</p>
                                <small class="d-block text-center text-decoration-underline"><a
                                        class="fw-semibold text-dark" href="/admin/film">chi tiết</a></small>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Total Revenue -->
            <div class="col-12 col-lg-12 order-2 order-md-2 order-lg-2 mb-4 p-0">
                <div class="card">
                    <div class="row row-bordered g-0 mb-2 p-3">
                        <div class="card-title mb-4">
                            <h5 class="text-nowrap mb-2 text-secondary">Tổng lượt xem</h5>
                        </div>                        
                        <div class="admin-table-user"
                            style="
                            overflow: scroll;
                        ">
                            <table class="table table-bordered table-hover">
                                <thead class="table-head text-center">
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th><span style="width:  200px;display: inline-block">Ngày tạo</span></th>
                                    <th><span style="width:  200px;display: inline-block">Truy cập lần cuối</span></th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($user_data as $user)
                                        <tr>
                                            <td style="text-align: center">{{ $user->user_id }}</td>
                                            <td>{{ $user->user_name }}</td>
                                            <td>{{ $user->user_email }}</td>
                                            <td style="text-align: center">{{ $user->created_at }}</td>
                                            <td style="text-align: center">{{ $user->last_login }}</td>
                                            <td>
                                                <form class="d-inline-block" action="{{ route('adminuser.delete') }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="ti-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script>
        var xValues = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9',
            'Tháng 10', 'Tháng 11', 'Tháng 12'
        ];

        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    data: [860, 1140, 1060, 1060, 1070, 1110, 1330, 2210, 7830, 2478],
                    borderColor: "blue",
                    fill: false
                }]
            },
            options: {
                legend: {
                    display: false
                }
            }
        });
    </script>
@endsection
