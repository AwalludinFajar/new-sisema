        <?php
        if (!defined('BASEPATH')) exit('No direct script access allowed');
        if (!function_exists('element')) {


            // ! INFO : Silahkan masukan Custome fungction disini ! // 
            // untuk membantu mempermudah scripting pada modular  
            // Daftar Isi : . . . . . . . . . . . . . . . . . . . 
            // 1. Load Template [1]
            // 2. Rules Form Validation [2]
            // 3. Message Alert template [3]
            // 4. Authentikasi user blocked [4]


            //=====>> Load Template [1] <<=====//

            function load_template($template, $data = null)
            {
                $ci = get_instance();
                $data['load_content'] = $ci->load->view($template, $data, true);
                $ci->load->view('header');
				$ci->load->view('navbar', $data);
				$ci->load->view('sidebar', $data);
                $ci->load->view('content', $data);
                $ci->load->view('footer');
            }

            function load_auth($template, $data = "")
            {
                $ci = get_instance();
                $data['load_content'] = $ci->load->view($template, $data, true);
                $ci->load->view('auth.php', $data);
            }

            //=====>> End Load Template [1] <<=====//




            //=====>> Rules Form Validation [2] <<=====//

            function reg_rules()
            {
                return [
                    [
                        'field' => 'name',
                        'label' => 'Nama',
                        'rules'  => 'trim|required',
                        'errors' => array(
                            'required' => '%s tidak boleh kosong'
                        )
                    ],
                    [
                        'field' => 'email',
                        'label' => 'Email',
                        'rules'  => 'required|trim|valid_email',
                        'errors' => array(
                            'required' => '%s tidak boleh kosong',
                            'valid_email' => '%s tidak boleh kosong'
                        )
                    ],
                    [
                        'field' => 'password1',
                        'label' => 'Password',
                        'rules'  => 'required|min_length[6]',
                        'errors' => array(
                            'required' => '%s tidak boleh kosong',
                            'min_length' => '%s minimal 6 karakter'

                        )
                    ],
                    [
                        'field' => 'password2',
                        'label' => 'Confrim',
                        'rules'  => 'required|matches[password1]|min_length[6]',
                        'errors' => array(
                            'required' => '%s harus diisi',
                            'matches' => '%s tidak sama',
                            'min_length' => '%s minimal 6 karakter'
                        )
                    ]

                ];
            }

            function addtodo_rules()

            {
                return [
                    [
                        'field' => 'subject',
                        'label' => 'subject',
                        'rules'  => 'trim|required',
                        'errors' => array(
                            'required' => '%s tidak boleh kosong'
                        )
                    ],
                    [
                        'field' => 'message',
                        'label' => 'message',
                        'rules'  => 'trim|required',
                        'errors' => array(
                            'required' => '%s tidak boleh kosong'
                        )
                    ],
                    [
                        'field' => 'duedate',
                        'label' => 'duedate',
                        'rules'  => 'trim|required',
                        'errors' => array(
                            'required' => '%s tidak boleh kosong'
                        )
                    ],
                    [
                        'field' => 'user_recived',
                        'label' => 'Pilih salah satu untuk siapa todos ini',
                        'rules'  => 'trim|required',
                        'errors' => array(
                            'required' => '%s tidak boleh kosong'
                        )
                    ],

                ];
            }


            function log_rules()
            {
                return [
                    [
                        'field' => 'email',
                        'label' => 'Email',
                        'rules'  => 'trim|required|valid_email',
                        'errors' => array(
                            'required' => '(* Field %s tidak boleh kosong !',
                            'valid_email' => 'Email tidak valid contoh : example@dwg.co.id'
                        )
                    ],
                    [
                        'field' => 'password',
                        'label' => 'Password',
                        'rules'  => 'required|min_length[3]',
                        'errors' => array(
                            'required' => '(* Field %s tidak boleh kosong !',
                            'min_length' => '%s minimal 3 karakter'
                        )
                    ]
                ];
            }
            //=====>> End Rules Form Validation [2] <<=====//



            //=====>> Message Alert template [3] <<=====//

            function destroy_flashdata()
            {
                danger_message('');
                success_message('');
                info_message('');
            }

            function danger_message($mesaage)
            {
                $ci = get_instance();
                $ci->session->set_flashdata('message', $mesaage);
                $ci->session->set_flashdata('type', 'danger');
            }

            function success_message($mesaage)
            {
                $ci = get_instance();
                $ci->session->set_flashdata('message', $mesaage);
                $ci->session->set_flashdata('type', 'success');
            }

            function info_message($mesaage)
            {
                $ci = get_instance();
                $ci->session->set_flashdata('message', $mesaage);
                $ci->session->set_flashdata('type', 'info');
            }

            //=====>> End Message Alert template [3] <<=====//


            //=====>> Authentikasi user blocked [4] <<=====//

            function blocked()
            {
                $ci = get_instance();
                if (!$ci->session->userdata('email')) {
                    redirect('auth');
                } else {
                    $role_id = $ci->session->userdata('role_id');
                    $menu = $ci->uri->segment(1);

                    $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
                    $menu_id = $queryMenu['id'];

                    $userAccess = $ci->db->get_where('user_access_menu', [
                        'role_id' => $role_id,
                        'menu_id' => $menu_id
                    ]);

                    if ($userAccess->num_rows() < 1) {
                        redirect('auth/blocked');
                    }
                }
            }

            //=====>> End Authentikasi user blocked [4] <<=====//


            //=====>> date and time format [5] <<=====//
            function wkt_now()
            {

                date_default_timezone_set('Asia/Jakarta');
                return ' ' . date('H:i:s', time());
                // untuk mendapatan waktu sekarang
            }

            function tgl_now()
            {

                date_default_timezone_set('Asia/Jakarta');
                return date('Y-m-d H:i:s');
                // untuk untuk mendapatkan waktu dan tanggal skrang

            }

            function dateTime($tgl)
            {

                $hasil = strtotime($tgl);
                return date('d-m-Y H:i:s', $hasil);
                // untuk merubah tanggal format db ke indonesia
            }

            function dateTimeAlfa($tgl)
            {

                $hasil = strtotime($tgl);
                return date('d,F Y H:i:s', $hasil);
                // untuk merubah tanggal format db ke indonesia
            }

            function Format_addtime($tgl)
            {
                $hasil = strtotime($tgl . '23:59:00');
                return date('Y-m-d H:i:s', $hasil);
                // untuk merubah tgl format indo saja -> ke format db & add waktu sekarang
            }




            //=====>> date and time format [5] <<=====//



        }
        
        // function check_access($role_id, $menu_id)
        // {
        //     $ci = get_instance();

        //     $ci->db->where('role_id', $role_id);
        //     $ci->db->where('menu_id', $menu_id);
        //     $result = $ci->db->get('user_access_menu');

        //     if ($result->num_rows() > 0) {
        //         return "checked='checked'";
        //     }
        // }
