<?php
/**
 * Route definitions.
 * Format: 'path' => ['ControllerClass', 'method']
 *
 * Path tanpa leading slash. '/' = halaman utama.
 * POST/GET handling dilakukan di dalam controller.
 */
return array(
    '/'               => array('KaryawanController', 'index'),
    'karyawan'        => array('KaryawanController', 'index'),
    'karyawan/tambah' => array('KaryawanController', 'tambah'),
    'karyawan/edit'   => array('KaryawanController', 'edit'),
    'karyawan/hapus'  => array('KaryawanController', 'hapus'),

    'cuti'            => array('CutiController', 'index'),
    'cuti/tambah'     => array('CutiController', 'tambah'),
    'cuti/status'     => array('CutiController', 'status'),
);
