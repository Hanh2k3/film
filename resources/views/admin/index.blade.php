@extends('admin.layouts.master')
@section('link-style')
    <link rel="stylesheet" href="{{ asset('admin/template/css/dashboard.css') }}">
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Total Revenue -->
            <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0 mb-2 p-1">
                        <h5 class="card-header m-0 p-3 text-secondary mb-3">Biểu đồ lượng người dùng</h5>
                        <div class="admin-table-user"
                            style="
                            overflow: scroll;
                        ">
                            <table class="table table-bordered table-hover">
                                <thead class="table-success text-center">
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
            <!--/ Total Revenue -->
            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h5 class="text-nowrap mb-2 text-secondary">Người dùng</h5>
                                </div>
                                <div class="mt-0 text-center">
                                    <h4 class="mb-0">{{ sizeof($user_data) }}</h4>
                                </div>
                                <div class="mt-3">
                                    <p class="m-0 fw-semibold text-secondary">Truy cập hôm nay: <span
                                            class="text-success">{{ $user_today }}</span></p>
                                    <p class="m-0 fw-semibold text-secondary">Truy cập tháng này: <span
                                            class="text-success">{{ $user_month }}</span></p>
                                    <p class="m-0 fw-semibold text-secondary">Truy cập năm nay: <span
                                            class="text-success">{{ $user_year }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="d-block mb-1 text-center fw-semibold text-secondary">Tổng phim</span>
                                <h4 class="card-title text-nowrap mb-2 text-center">{{ sizeof($film_data) }} bộ</h4>
                                @php
                                    $film_episode_full = 0;
                                    foreach ($film_data as $film) {
                                        $film->aired_episodes !== $film->episodes_quantity && $film_episode_full++;
                                    }
                                @endphp
                                <p class="m-0 fw-semibold text-center text-secondary">Đã chiếu đủ</p>
                                <p class="m-0 fw-semibold text-center text-success">
                                    {{ sizeof($film_data) - $film_episode_full }} bộ</p>
                                <p class="m-0 fw-semibold text-center text-secondary">Chưa chiếu đủ</p>
                                <p class="m-0 fw-semibold text-center text-warning">{{ $film_episode_full }} bộ</p>
                                <small class="d-block text-center mt-2 text-decoration-underline"><a
                                        class="fw-semibold text-dark" href="/admin/film">chi tiết</a></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1 text-secondary">Tổng lượt xem</span>
                                @php
                                    $film_view_total = 0;
                                    foreach ($film_data as $film) {
                                        $film_view_total += $film->view;
                                    }
                                @endphp
                                <h4 class="card-title text-nowrap mb-2 text-center ">{{ $film_view_total }}</h4>
                                <p class="m-0 fw-semibold text-center text-secondary">Bộ xem nhiều nhất</p>
                                <p class="m-0 fw-semibold text-center text-success">Mã ID: {{ $film_data[0]->film_id }}</p>
                                <p class="m-0 fw-semibold text-center text-success">Tên: {{ $film_data[0]->film_name }}</p>
                                <p class="m-0 fw-semibold text-center text-success">L.xem: {{ $film_data[0]->view }}</p>
                                <small class="d-block text-center mt-2 text-decoration-underline"><a
                                        class="fw-semibold text-dark" href="/admin/film">chi tiết</a></small>
                            </div>
                        </div>
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
