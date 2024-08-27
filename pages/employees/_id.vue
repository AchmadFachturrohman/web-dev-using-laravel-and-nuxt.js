<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>
                    Edit Employee
                    <Nuxt-link to="/employees" class="btn btn-danger float-end">
                        <a>
                            <i class="fa-solid fa-circle-chevron-left"></i>
                        </a>
                        Back
                    </Nuxt-link>
                </h4>
            </div>
            <div class="card-body">
                <Loading v-if="isFetching" class="ms-2" title="Fetching Data..." />
                <form v-else @submit.prevent="updateEmployee">
                    <div class="mb-3">
                        <label>NIP</label>
                        <input type="number" v-model="employee.nip" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" v-model="employee.name" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label>Kota Kelahiran</label>
                        <input type="text" v-model="employee.city_of_birth" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label>Alamat</label>
                        <input type="text" v-model="employee.address" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label>Tanggal Lahir</label>
                        <input type="Date" v-model="employee.birth_date" class="form-control"
                            :class="{ 'is-invalid': errors.birth_date && errors.birth_date.length > 0 }" />
                        <div v-if="errors.birth_date && errors.birth_date.length > 0" class="invalid-feedback">
                            {{ errors.birth_date[0] }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="genderMale" value="Laki-laki"
                                v-model="employee.gender"
                                :class="{ 'is-invalid': errors.gender && errors.gender.length > 0 }">
                            <label class="form-check-label" for="genderMale">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="genderFemale" value="Perempuan"
                                v-model="employee.gender"
                                :class="{ 'is-invalid': errors.gender && errors.gender.length > 0 }">
                            <label class="form-check-label" for="genderFemale">
                                Perempuan
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Golongan</label>
                        <div class="input-group mb-3">
                            <select class="form-select" v-model="employee.gol_id"
                                :class="{ 'is-invalid': errors.gol_id && errors.gol_id.length > 0 }">
                                <option v-for="golongan in golongans" :key="golongan.id" :value="golongan.id">
                                    {{ golongan.name }}
                                </option>
                            </select>
                            <div v-if="errors.gol_id && errors.gol_id.length > 0" class="invalid-feedback">
                                {{ errors.gol_id[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Jabatan</label>
                        <div class="input-group mb-3">
                            <select class="form-select" v-model="employee.jabatan_id">
                                <option v-for="jabatan in jabatans" :key="jabatan.id" :value="jabatan.id"
                                    :class="{ 'is-invalid': errors.jabatan_id && errors.jabatan_id.length > 0 }">
                                    {{ jabatan.name }}
                                </option>
                            </select>
                            <div v-if="errors.jabatan_id && errors.jabatan_id.length > 0" class="invalid-feedback">
                                {{ errors.jabatan_id[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Tempat Tugas</label>
                        <input type="text" v-model="employee.duty_loc" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label>Agama</label>
                        <div class="input-group mb-3">
                            <select class="form-select" id="selectedReligion" v-model="employee.religion"
                                :class="{ 'is-invalid': errors.religion && errors.religion.length > 0 }">
                                <option selected></option>
                                <option value="1">Islam</option>
                                <option value="2">Kristen</option>
                                <option value="3">Katholik</option>
                                <option value="3">Hindu</option>
                                <option value="3">Buddha</option>
                                <option value="3">Konghuchu</option>
                                <option value="3">Lainnya</option>
                            </select>
                            <div v-if="errors.religion && errors.religion.length > 0" class="invalid-feedback">
                                {{ errors.religion[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Unit Kerja</label>
                        <input type="text" v-model="employee.unit_kerja" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label>No. HP</label>
                        <input type="number" v-model="employee.phone_number" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label>NPWP</label>
                        <input type="number" v-model="employee.npwp" class="form-control" />
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                        <button type="submit" class="btn btn-success">
                            <a>
                                <i class="fa-solid fa-floppy-disk"></i>
                            </a>
                            Save Changes
                        </button>
                        <Loading v-if="isLoading" class="ms-2" title="Saving..." />
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Loading from '~/components/Loading.vue';
import axios from 'axios';

export default {
    name: "employeeEdit",
    data() {
        return {
            golongans: [],
            jabatans: [],
            selectedGolongan: null,
            selectedJabatan: null,

            employee: {
                nip: '',
                name: '',
                city_of_birth: '',
                address: '',
                birth_date: '',
                gender: '',
                gol_id: '',
                jabatan_id: '',
                duty_loc: '',
                religion: '',
                unit_kerja: '',
                phone_number: '',
                npwp: ''
            },
            errors: {
                birth_date: [],
                gender: [],
                gol_id: [],
                jabatan_id: [],
                religion: []
            },
            isLoading: false,
            isFetching: false
        }
    },
    watch: {
        'employee.nip': function (newVal) {
            this.employee.nip = newVal ? newVal.toString() : '';
        },
        'employee.phone_number': function (newVal) {
            this.employee.phone_number = newVal ? newVal.toString() : '';
        },
        'employee.npwp': function (newVal) {
            this.employee.npwp = newVal ? newVal.toString() : '';
        }
    },
    mounted() {
        this.employeeId = this.$route.params.id;
        this.getEmployeeById(this.employeeId);

        this.$axios.get('/golongan')
            .then(responseGolongan => {
                this.golongans = responseGolongan.data;
                return this.$axios.get('/jabatan');
            })
            .then(responseJabatan => {
                this.jabatans = responseJabatan.data;
            })
            .catch(error => {
                console.error('Error fetching data', error);
            });
    },
    methods: {
        getEmployeeById(employeeId) {
            this.isFetching = true;
            axios.get(`http://localhost:8000/api/employee/${employeeId}`).then(res => {
                this.isFetching = false;
                this.employee = res.data.data;
            });
        },

        updateEmployee() {
            // console.log();
            this.isLoading = true;

            axios.put(`http://localhost:8000/api/employee/edit/${this.employeeId}`, this.employee)
                .then(res => {
                    this.isLoading = false;
                    this.$swal({
                        position: "center",
                        icon: "success",
                        title: res.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        this.$router.push('/employees')
                    })

                    this.errors = {
                        birth_date: [],
                        gender: [],
                        gol_id: [],
                        jabatan_id: [],
                        religion: []
                    };
                })
                .catch(error => {
                    this.isLoading = false;
                    if (error.response.data.status == 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        this.errors = {
                            birth_date: [],
                            gender: [],
                            gol_id: [],
                            jabatan_id: [],
                            religion: []
                        };
                    }
                });
        }
    }
}
</script>

<style scoped>
.container {
    min-height: 78vh;
}

.is-invalid {
    border-color: red;
}

.invalid-feedback {
    color: red;
}
</style>