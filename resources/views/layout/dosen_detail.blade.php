@if(Auth::user()->login_type == 'admin')
    <div class="kt-subheader__wrapper">
        <div class="kt-portlet__head-toolbar">
            <a href="#" class="btn btn-label-success btn-sm btn-bold dropdown-toggle" data-toggle="dropdown">
                <i class="kt-nav__link-icon flaticon2-layers-2"></i> Menu Lainnya
            </a>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                <ul class="kt-nav">
                    <li class="kt-nav__item">
                        <a href="{{url('data/dosen/view/'.$data['id'])}}" class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon2-user"></i>
                            <span class="kt-nav__link-text">Detail Dosen</span>
                        </a>
                    </li>
                    <li class="kt-nav__item">
                        <a href="{{url('dosen/penugasan/'.$data['id'])}}" class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon2-digital-marketing"></i>
                            <span class="kt-nav__link-text">Penugasan Dosen</span>
                        </a>
                    </li>
                    <li class="kt-nav__item">
                        <a href="{{url('data/dosen/activity/'.$data['id'])}}" class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon2-calendar-4"></i>
                            <span class="kt-nav__link-text">Aktivitas Mengajar Dosen</span>
                        </a>
                    </li>
                    <li class="kt-nav__item">
                        <a href="{{url('dosen/fungsional/'.$data['id'])}}" class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon2-cardiogram"></i>
                            <span class="kt-nav__link-text">Riwayat Fungsional</span>
                        </a>
                    </li>
                    <li class="kt-nav__item">
                        <a href="{{url('dosen/pengangkatan/'.$data['id'])}}" class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon2-indent-dots"></i>
                            <span class="kt-nav__link-text">Riwayat Kepangkatan</span>
                        </a>
                    </li>
                    <li class="kt-nav__item">
                        <a href="{{url('dosen/pendidikan/'.$data['id'])}}" class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon2-graphic"></i>
                            <span class="kt-nav__link-text">Riwayat Pendidikan</span>
                        </a>
                    </li>
                    <li class="kt-nav__item">
                        <a href="{{url('dosen/sertifikasi/'.$data['id'])}}" class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon2-crisp-icons"></i>
                            <span class="kt-nav__link-text">Riwayat Sertifikasi</span>
                        </a>
                    </li>
                    <li class="kt-nav__item">
                        <a href="{{url('dosen/penelitian/'.$data['id'])}}" class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon2-graph-2"></i>
                            <span class="kt-nav__link-text">Riwayat Penelitian</span>
                        </a>
                    </li>
                    <li class="kt-nav__item">
                        <a href="{{url('dosen/pembimbing/'.$data['id'])}}" class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon2-avatar"></i>
                            <span class="kt-nav__link-text">Pembimbing Aktivitas Mahasiswa</span>
                        </a>
                    </li>
                    <li class="kt-nav__item">
                        <a href="{{url('dosen/penguji/'.$data['id'])}}" class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon2-infographic"></i>
                            <span class="kt-nav__link-text">Penguji Aktivitas Mahasiswa</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endif