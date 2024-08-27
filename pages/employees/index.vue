<template>
  <div class="container">
    <div>
      <div class="d-flex justify-content-center align-items-center">
        <h4>Employee Lists</h4>
      </div>
      <div class="d-flex justify-content-between align-items-center">
        <div class="col-auto me-3">
          <label>Filter By Jabatan</label>
        </div>
        <div class="col-auto">
          <select
            ref="jabatanSelect"
            class="form-select custom-width me-3"
            @change="filterEmployeesByJabatan($event.target.value)"
          >
            <option value="0">All</option>
            <option
              v-for="jabatan in jabatans"
              :key="jabatan.id"
              :value="jabatan.id"
            >
              {{ jabatan.name }}
            </option>
          </select>
        </div>
        <div class="col-auto ms-auto">
          <nuxt-link to="/employees/create" class="btn btn-primary me-2">
            <i class="fa-solid fa-plus"></i> Add Employee
          </nuxt-link>
          <button @click="exportToExcel" class="btn btn-success">
            <i class="fa-solid fa-download"></i> Export Excel
          </button>
        </div>
      </div>
      <div class="d-flex justify-content-between align-items-center mt-3">
        <div class="input-group ms-auto" style="width: 290px">
          <input
            ref="clearSearch"
            type="search"
            class="form-control"
            placeholder="Name, NIP or NPWP"
            aria-label="Recipient's username"
            aria-describedby="basic-addon2"
            @input="searchEmployees"
          />
          <span class="input-group-text" id="basic-addon2"
            ><i class="fa-solid fa-magnifying-glass"></i
          ></span>
        </div>
      </div>
    </div>

    <div class="mt-3">
      <Loading v-if="isLoading" title="Fetching Data..." />
      <table v-else class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th hidden>ID</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Tempat Lahir</th>
            <th>Alamat</th>
            <th>Tgl Lahir</th>
            <th>L/P</th>
            <th>Gol</th>
            <th>Eselon</th>
            <th>Jabatan</th>
            <th>Tempat Tugas</th>
            <th>Agama</th>
            <th>Unit Kerja</th>
            <th>No. HP</th>
            <th>NPWP</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(employee, index) in employees" :key="index">
            <td>{{ index + 1 }}</td>
            <td hidden>{{ employee.id }}</td>
            <td>{{ employee.nip }}</td>
            <td>{{ employee.name }}</td>
            <td>{{ employee.city_of_birth }}</td>
            <td>{{ employee.address }}</td>
            <td>{{ employee.birth_date }}</td>
            <td>{{ employee.gender }}</td>
            <td>{{ employee.golongan }}</td>
            <td>{{ employee.eselon }}</td>
            <td>{{ employee.jabatan }}</td>
            <td>{{ employee.duty_loc }}</td>
            <td>{{ employee.religion }}</td>
            <td>{{ employee.unit_kerja }}</td>
            <td>{{ employee.phone_number }}</td>
            <td>{{ employee.npwp }}</td>
            <td style="width: 120px">
              <nuxt-link
                :to="`/employees/${employee.id}`"
                class="btn btn-sm mx-2"
                ><i class="fa-solid fa-pen-to-square" style="color: #005eff"></i
              ></nuxt-link>
              <button
                @click="deleteEmployee($event, employee.id)"
                class="btn btn-sm mx-2"
              >
                <i class="fa-solid fa-trash-can" style="color: #ff0000"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";

export default {
  name: "employee",
  data() {
    return {
      employees: [],
      jabatans: [],
      isLoading: true,
    };
  },
  mounted() {
    this.$axios
      .get("/jabatan")
      .then((responsejabatan) => {
        this.jabatans = responsejabatan.data;
      })
      .catch((error) => {
        console.error("Error fetching data", error);
      });

    this.getEmployees();
  },
  methods: {
    getEmployees() {
      this.isLoading = true;
      axios
        .get("http://localhost:8000/api/employee")
        .then((res) => {
          // console.log(res);
          this.isLoading = false;
          this.employees = res.data.data;
        })
        .catch((error) => {
          console.error("Error fetching employees:", error);
        });
    },

    deleteEmployee(event, employeeId) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-primary ms-2",
          cancelButton: "btn btn-danger",
        },
        buttonsStyling: false,
      });
      swalWithBootstrapButtons
        .fire({
          title: "Are you sure " + `${employeeId}` + " ?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No, cancel!",
          reverseButtons: true,
        })
        .then((result) => {
          if (result.isConfirmed) {
            axios
              .delete(`http://localhost:8000/api/employee/delete/${employeeId}`)
              .then((res) => {
                this.getEmployees();
              });
            swalWithBootstrapButtons.fire({
              title: "Deleted!",
              text: "Your file has been deleted.",
              icon: "success",
            });
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire({
              title: "Cancelled",
              text: "Your imaginary file is safe :)",
              icon: "error",
            });
          }
        });
    },

    filterEmployeesByJabatan(jabatanId) {
      this.isLoading = true;
      if (jabatanId == 0) {
        this.isLoading = false;
        this.getEmployees();
      } else {
        axios
          .get(`http://localhost:8000/api/employee-filter/${jabatanId}`)
          .then((res) => {
            this.isLoading = false;
            this.employees = res.data.data;
          })
          .catch((error) => {
            this.isLoading = false;
            if (error.response.data.status == 404) {
              this.errors = error.response.data;
              this.$swal({
                icon: "error",
                title: "Oops...",
                text: this.errors.message,
              });
              this.$refs.jabatanSelect.value = "0";
              this.getEmployees;
            }
          });
      }
    },

    searchEmployees(event) {
      this.isLoading = true;
      const query = event.target.value;
      this.$axios
        .get(`http://localhost:8000/api/employee-search`, {
          params: { name: query, nip: query, npwp: query },
        })
        .then((res) => {
          this.employees = res.data.data;
          this.isLoading = false;
          // this.$refs.clearSearch
        })
        .catch((error) => {
          console.error("Error fetching employees", error);
          if (error.response.data.status == 404) {
            this.errors = error.response.data;
            this.$swal({
              icon: "error",
              title: "Oops...",
              text: this.errors.message,
            });
            this.getEmployees;
          }
        });
    },

    exportToExcel() {
      // URL of your Laravel export route
      const url = "http://localhost:8000/api/employees/export";

      // Create an invisible link element
      const link = document.createElement("a");
      link.href = url;
      link.target = "_blank"; // Open in a new tab
      link.click(); // Trigger the download
    },
  },
};
</script>

<style scoped>
.container {
  min-height: 75vh;
}

.custom-width {
  width: 150px;
  /* Adjust the width as needed */
}
</style>
