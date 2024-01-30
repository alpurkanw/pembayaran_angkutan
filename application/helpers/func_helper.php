<?php

function cek_akses()
{
    $ins = get_instance();

    if (!$ins->session->userdata('usernm')) {
        redirect('auth/blocked');
        return;
    } else {
        $segment1 = $ins->uri->segment(1);
        $level = $ins->session->userdata('level');
        if ($segment1 == "satgas") {
            if ($level !== "1") {
                redirect('auth/blocked');
                return;
            }
        }

        // if ($segment1 == "admin") {
        //     if ($level !== "2") {
        //         redirect('auth/blocked');
        //         return;
        //     }
        // }
        // if ($segment1 == "kasir") {
        //     if ($level !== "3") {
        //         redirect('auth/blocked');
        //         return;
        //     }
        // }
    }
}

function approval($dt)
{

    $ins = get_instance();
    // echo "approval" . $id;

    $ins->db->where(['id' => $dt["id"]]);
    $ins->db->update('mst_warga', ['st_app' => 1]);

    // $data["judul"] = "List Warga";
    if ($ins->db->affected_rows() == 1) {

        $ins->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success py-1" role="alert">
                        Success Approved.
                    </div>'
        );
        redirect(base_url($dt["direct"]));
        return;

        // redirect('C_daftar');
        // return;
    } else {
        redirect(base_url($dt["direct"]));
        return;
    }
}


function reject($dt)
{


    $ins = get_instance();
    // echo "approval" . $id;

    $ins->db->where(['id' => $dt["id"]]);
    $ins->db->update('mst_warga', ['st_app' => 0]);

    // $data["judul"] = "List Warga";
    if ($ins->db->affected_rows() == 1) {

        $ins->session->set_flashdata(
            'pesan',
            '<div class="alert alert-danger py-1" role="alert">
                    Succes Rejected!.
                </div>'
        );
        redirect(base_url($dt["direct"]));
        return;

        // redirect('C_daftar');
        // return;
    } else {
        redirect(base_url($dt["direct"]));
        return;
    }
}

function histori($list)
{


    return '
    ' . $list . '
        
    ';
}
