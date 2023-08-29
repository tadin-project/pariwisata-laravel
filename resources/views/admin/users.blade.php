<div class="card">
  <div class="card-header">
    <h1 class="card-title"><i class="fas fa-list-ul fa-1x me-2"></i>Data {{ $title }}</h1>
    <div class="card-toolbar">
      <button class="btn btn-primary btn-sm" id="btnAdd">
        <i class="fa fa-plus"></i> Data
      </button>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-rounded table-hover table-striped table-bordered" id="tableVendor">
        <thead>
          <tr>
            <th class="text-center">No.</th>
            <th class="text-center">Username</th>
            <th class="text-center">Email</th>
            <th class="text-center">Jenis</th>
            <th class="text-center">Status</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="modalFormVendor" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Form {{ $title }}</h3>
        <!--begin::Close-->
        <div class="btn btn-icon btn-sm btn-active-light-danger ms-2" aria-label="Close" onclick="btnBatal.click()">
          <i class="fas fa-times fs-1"></i>
        </div>
        <!--end::Close-->
      </div>
      <div class="modal-body">
        <form id="formVendor" class="form" autocomplete="off">
          <!--begin::Input group-->
          <div class="fv-row mb-10">
            <label class="required fw-semibold fs-6 mb-2">Nama</label>
            <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0"
              placeholder="" value="" />
          </div>
          <div class="fv-row mb-10">
            <label class="required fw-semibold fs-6 mb-2">Username</label>
            <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0"
              placeholder="" value="" />
          </div>
          <div class="fv-row mb-10">
            <label class="required fw-semibold fs-6 mb-2">Hak Akses</label>
            <select name="id_group" id="id_group" class="form-control form-control-solid mb-3 mb-lg-0">
              @foreach ($list_group as $v)
                <option value="{{ $v->group_id }}">{{ $v->group_nama }}</option>
              @endforeach
            </select>
          </div>
          <!--end::Input group-->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" id="btnBatal">Tutup</button>
        <button id="btnSimpan" type="submit" class="btn btn-primary">
          <span class="indicator-label">Simpan</span>
          <span class="indicator-progress">
            Loading... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
          </span>
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  // global
  const baseDir = baseUrl + "/admin/users";

  // table
  const btnAdd = $("#btnAdd"),
    tableVendor = $("#tableVendor");

  // form
  const modalFormVendor = $("#modalFormVendor"),
    formVendor = $("#formVendor"),
    btnSimpan = $("#btnSimpan"),
    btnBatal = $("#btnBatal");

  let fv

  // Class definition
  var PageAdvanced = function() {
    // Shared variables
    var table;
    var dt;

    // Private functions
    var initDatatable = function() {
      dt = tableVendor.DataTable({
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        order: [
          [1, 'asc']
        ],
        ajax: {
          url: baseDir + "/get-data",
        },
        columnDefs: [{
          targets: [0, -1],
          orderable: false,
        }, {
          targets: [0, -2, -1],
          className: "text-center"
        }, {
          targets: [0],
          width: "5%"
        }, {
          targets: [-1],
          width: "12%"
        }, {
          targets: [-2],
          width: "8%"
        }, ],
        language: {
          lengthMenu: "Show _MENU_",
        },
      });

      table = dt.$;
    }

    var initForm = function() {
      fv = FormValidation.formValidation(
        formVendor[0], {
          fields: {
            'name': {
              validators: {
                notEmpty: {
                  message: 'Nama wajib diisi'
                }
              }
            },
          },

          plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5({
              rowSelector: '.fv-row',
              eleInvalidClass: '',
              eleValidClass: ''
            })
          }
        }
      );

      // Submit button handler
      formVendor.submit(function(e) {
        // Prevent default button action
        e.preventDefault();

        // Validate form before submit
        if (fv) {
          fv.validate().then(function(status) {
            console.log('validated!');

            if (status == 'Valid') {
              // Show loading indication
              btnSimpan.attr('data-kt-indicator', 'on');

              // Disable button to avoid multiple click
              btnSimpan.attr('disabled', 'disabled');

              // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
              setTimeout(function() {
                // Remove loading indication
                btnSimpan.removeAttr('data-kt-indicator', 'on');
                btnSimpan.removeAttr('disabled', 'disabled');

                // Show popup confirmation
                successMessage({
                  message: "Data berhasil disimpan"
                });

                //form.submit(); // Submit form
              }, 2000);
            }
          });
        }
      });
    }

    // Public methods
    return {
      init: function() {
        initDatatable();
        initForm();
      }
    }
  }();

  function fnResetForm() {
    formVendor[0].reset();
    fv.resetForm();
  }

  $(document).ready(function() {
    PageAdvanced.init();

    btnAdd.click(function() {
      fnResetForm();
      modalFormVendor.modal("show");
    });

    btnBatal.click(function() {
      fnResetForm();
      modalFormVendor.modal("hide");
    });

    btnSimpan.click(function() {
      formVendor.submit();
    })
  });
</script>
