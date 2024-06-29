<x-app-layout>
    <div class="sm:mx-6 lg:mx-8 p-6 py-10 bg-secondary text-secondary-content rounded overflow-x-auto"
        x-data="data()">
        <div class="flex flex-col sm:flex-row items-center sm:items-start p-4 gap-8 sm:gap-2">
            {{-- alert --}}
            <div class="fixed z-10 text-sm w-32 left-1/2 -translate-x-1/2 bg-primary text-primary-content rounded p-2 font-bold  text-center"
                x-show='isAlertShow' x-transition:enter="transition-opacity ease-out duration-100"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-in duration-100" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" x-init="$watch('isAlertShow', value => {
                    if (value) {
                        setTimeout(() => isAlertShow = false, 1000);
                    }
                })">
                Tersimpan !
            </div>

            {{-- LEFT SIDE --}}
            <div class="card w-80 bg-base-200 shadow-xl">
                <figure class="px-10 pt-10 pb-2">
                    <div class="avatar">
                        <div class="w-full rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                            <img src="{{ isset(auth()->user()->img) ? Storage::url(auth()->user()->img) : asset('assets/images/image-not-found.webp') }}"
                                alt="profile picture" id='profile-photo' />

                            <div class="absolute rounded-full bg-primary/80 opacity-0 hover:opacity-100 w-full h-full top-0 flex justify-center items-center cursor-pointer transition-opacity duration-700"
                                @click="$refs.photoInput.click()">
                                <div class="tooltip" data-tip="Ganti Foto">
                                    <i class="fa fa-pencil text-primary-content"></i>
                                </div>
                            </div>

                            <!-- Hidden File Input -->
                            <input type="file" class="hidden" x-ref="photoInput" @change="uploadPhoto">
                        </div>
                    </div>
                </figure>
                <div class="card-body items-center text-center">
                    <h2 class="card-title" x-text="user.fullname"></h2>

                    <p x-show="!isEditingStatus" x-text="user.status"></p>
                    <div @click.outside="cancelEditingStatus">
                        <textarea x-show="isEditingStatus" type="text" x-model="tempStatus" class="my-input text-center" autocomplete="off"
                            x-ref="statusInput" @keydown.enter="isEditingStatus = !isEditingStatus; saveStatus()" x-init="$watch('isEditingStatus', value => {
                                if (value) {
                                    tempStatus = user.status
                                }
                            })"></textarea>
                        <div class="card-actions">
                            <button class="btn btn-primary btn-sm btn-ghost btn-circle opacity-5 hover:opacity-100"
                                @click="isEditingStatus = !isEditingStatus; if (!isEditingStatus) saveStatus(); else $nextTick(() => $refs.statusInput.focus());">
                                <i x-show="!isEditingStatus" class="fas fa-pencil"></i>
                                <i x-show="isEditingStatus" class="fas fa-circle-check"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT SIDE --}}
            <div class="flex-1 bg-base-200 shadow-xl card">
                <div x-data="{ activeTab: 1 }">
                    <div class="flex bg-base-300 rounded-t-2xl">
                        <button class="uppercase px-8 py-3 -mb-px text-sm rounded-t-2xl"
                            :class="activeTab === 1 ? 'border-base-200 bg-base-200' : 'text-gray-600'"
                            @click="activeTab = 1">
                            Biodata
                        </button>
                    </div>

                    <!-- Tab Contents -->
                    <div class="p-6 bg-base-200 rounded text-sm">
                        <div x-show="activeTab === 1">
                            <h2 class="font-bold uppercase mb-2">Data Diri</h2>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Nama Lengkap :</span>
                                <span x-show="!isEditingFullname" x-text='user.fullname'>
                                </span>
                                <div @click.outside="cancelEditingFullname">
                                    <input x-show="isEditingFullname" type="text" x-model="tempFullname"
                                        class="my-input" autocomplete="off" x-ref="fullnameInput"
                                        @keydown.enter="isEditingFullname = !isEditingFullname; saveFullname()"
                                        x-init="$watch('isEditingFullname', value => {
                                            if (value) {
                                                tempFullname = user.fullname
                                            }
                                        })">
                                    <span class="cursor-pointer opacity-5 hover:opacity-100"
                                        @click="isEditingFullname = !isEditingFullname; if (!isEditingFullname) saveFullname(); else $nextTick(() => $refs.fullnameInput.focus());">
                                        <i x-show="!isEditingFullname" class="fas fa-pencil"></i>
                                        <i x-show="isEditingFullname" class="fas fa-circle-check"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Nama Panggilan :</span>
                                <span x-show="!isEditingName" x-text='user.name'>
                                </span>
                                <div @click.outside="cancelEditingName">
                                    <input x-show="isEditingName" type="text" x-model="tempName" class="my-input"
                                        autocomplete="off" x-ref="nameInput"
                                        @keydown.enter="isEditingName = !isEditingName; saveName()"
                                        x-init="$watch('isEditingName', value => {
                                            if (value) {
                                                tempName = user.name
                                            }
                                        })">
                                    <span class="cursor-pointer opacity-5 hover:opacity-100"
                                        @click="isEditingName = !isEditingName; if (!isEditingName) saveName(); else $nextTick(() => $refs.nameInput.focus());">
                                        <i x-show="!isEditingName" class="fas fa-pencil"></i>
                                        <i x-show="isEditingName" class="fas fa-circle-check"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Tanggal Lahir
                                    :</span>
                                <span x-show="!isEditingBirthday" x-text='formattedBirthday'>
                                </span>
                                <div @click.outside="cancelEditingBirthday">
                                    <input x-show="isEditingBirthday" type="date" x-model="tempBirthday"
                                        class="my-input" autocomplete="off" x-ref="birthdayInput"
                                        @keydown.enter="isEditingBirthday = !isEditingBirthday; updateUserData()"
                                        x-init="$watch('isEditingBirthday', value => {
                                            if (value) {
                                                tempBirthday = formatBirthdayForInput(user.birthday);
                                            }
                                        })">
                                    <span class="cursor-pointer opacity-5 hover:opacity-100"
                                        @click="isEditingBirthday = !isEditingBirthday; if (!isEditingBirthday) saveBirthday(); else $nextTick(() => $refs.birthdayInput.focus());">
                                        <i x-show="!isEditingBirthday" class="fas fa-pencil"></i>
                                        <i x-show="isEditingBirthday" class="fas fa-circle-check"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Jenis Kelamin :</span>
                                <span x-show='!isEditingGender'
                                    x-text="user.gender === 'm' ? 'Laki' : (user.gender === 'f' ? 'Perempuan' : '-')">
                                </span>
                                <div @click.outside="cancelEditingGender">
                                    <select x-show="isEditingGender" x-model="tempGender" class="my-input"
                                        x-ref="genderInput"
                                        @keydown.enter="isEditingGender = !isEditingGender; saveGender()"
                                        x-init="$watch('isEditingGender', value => {
                                            if (value) {
                                                tempGender = user.gender;
                                            }
                                        })">
                                        <option class="bg-primary text-primary-content" value="m">Laki
                                        </option>
                                        <option class="bg-primary text-primary-content" value="f">Perempuan
                                        </option>
                                    </select>
                                    <span class="cursor-pointer opacity-5 hover:opacity-100"
                                        @click="isEditingGender = !isEditingGender; if (!isEditingGender) saveGender(); else $nextTick(() => $refs.genderInput.focus());">
                                        <i x-show="!isEditingGender" class="fas fa-pencil"></i>
                                        <i x-show="isEditingGender" class="fas fa-circle-check"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Status Pernikahan
                                    :</span>
                                <span x-show='!isEditingStatusPernikahan' class="capitalize"
                                    x-text='user["status-pernikahan"]'></span>

                                <div @click.outside="cancelEditingStatusPernikahan">
                                    <select x-show="isEditingStatusPernikahan" x-model="tempStatusPernikahan"
                                        x-ref='pernikahanInput' class="my-input"
                                        @keydown.enter="isEditingStatusPernikahan = !isEditingStatusPernikahan; saveStatusPernikahan()"
                                        x-init="$watch('isEditingStatusPernikahan', value => {
                                            if (value) {
                                                tempStatusPernikahan = user['status-pernikahan'];
                                            }
                                        })">
                                        <option class="bg-primary text-primary-content" value="Lajang">Lajang
                                        </option>
                                        <option class="bg-primary text-primary-content" value="Menikah">Menikah
                                        </option>
                                        <option class="bg-primary text-primary-content" value="Bercerai">Bercerai
                                        </option>
                                    </select>
                                    <span class="cursor-pointer opacity-5 hover:opacity-100"
                                        @click="isEditingStatusPernikahan = !isEditingStatusPernikahan; if (!isEditingStatusPernikahan) saveStatusPernikahan(); else $nextTick(() => $refs.pernikahanInput.focus());">
                                        <i x-show="!isEditingStatusPernikahan" class="fas fa-pencil"></i>
                                        <i x-show="isEditingStatusPernikahan" class="fas fa-circle-check"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Pekerjaan :</span>
                                <span x-show="!isEditingOccupation" x-text='user.occupation'></span>

                                <div @click.outside="cancelEditingOccupation">
                                    <input x-show="isEditingOccupation" type="text" x-model="tempOccupation"
                                        class="my-input" autocomplete="off" x-ref="occupationInput"
                                        @keydown.enter="isEditingOccupation = !isEditingOccupation; saveOccupation()"
                                        x-init="$watch('isEditingOccupation', value => {
                                            if (value) {
                                                tempOccupation = user.occupation
                                            }
                                        })">
                                    <span class="cursor-pointer opacity-5 hover:opacity-100"
                                        @click="isEditingOccupation = !isEditingOccupation; if (!isEditingOccupation) saveOccupation(); else $nextTick(() => $refs.occupationInput.focus());">
                                        <i x-show="!isEditingOccupation" class="fas fa-pencil"></i>
                                        <i x-show="isEditingOccupation" class="fas fa-circle-check"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Pendidikan :</span>
                                <span x-show='!isEditingEducation' x-text='user.education'></span>
                                <div @click.outside="cancelEditingEducation">
                                    <select x-show="isEditingEducation" x-model="tempEducation"
                                        x-ref='educationInput' class="my-input"
                                        @keydown.enter="isEditingEducation = !isEditingEducation; saveEducation()"
                                        x-init="$watch('isEditingEducation', value => {
                                            if (value) {
                                                tempEducation = user.education;
                                                console.log('val : ', value)
                                            }
                                        })">
                                        <option class="bg-primary text-primary-content" value="Tidak Sekolah">
                                            Tidak Sekolah</option>
                                        <option class="bg-primary text-primary-content" value="SD">SD</option>
                                        <option class="bg-primary text-primary-content" value="SMP">SMP
                                        </option>
                                        <option class="bg-primary text-primary-content" value="SMA">SMA
                                        </option>
                                        <option class="bg-primary text-primary-content" value="D3">D3</option>
                                        <option class="bg-primary text-primary-content" value="S1">S1</option>
                                        <option class="bg-primary text-primary-content" value="S1 Profesi">S1
                                            Profesi</option>
                                        <option class="bg-primary text-primary-content" value="S2">S2</option>
                                        <option class="bg-primary text-primary-content" value="S3">S3</option>
                                    </select>
                                    <span class="cursor-pointer opacity-5 hover:opacity-100"
                                        @click="isEditingEducation = !isEditingEducation; if (!isEditingEducation) saveEducation(); else $nextTick(() => $refs.educationInput.focus());">
                                        <i x-show="!isEditingEducation" class="fas fa-pencil"></i>
                                        <i x-show="isEditingEducation" class="fas fa-circle-check"></i>
                                    </span>
                                </div>
                            </div>

                            <h2 class="font-bold uppercase mb-2 mt-4">Kontak</h2>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Nomor HP :</span>
                                <span x-show='!isEditingHp' x-text='user.hp'></span>
                                <div @click.outside="cancelEditingHp">
                                    <input x-show="isEditingHp" type="text" x-model="tempHp" class="my-input"
                                        autocomplete="off" x-ref="hpInput"
                                        @keydown.enter="isEditingHp = !isEditingHp; saveHp()" x-init="$watch('isEditingHp', value => {
                                            if (value) {
                                                tempHp = user.hp
                                            }
                                        })">
                                    <span class="cursor-pointer opacity-5 hover:opacity-100"
                                        @click="isEditingHp = !isEditingHp; if (!isEditingHp) saveHp(); else $nextTick(() => $refs.hpInput.focus());">
                                        <i x-show="!isEditingHp" class="fas fa-pencil"></i>
                                        <i x-show="isEditingHp" class="fas fa-circle-check"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="flex gap-2 leading-10">
                                <span class="opacity-75">Email :</span>
                                <span x-show='!isEditingEmail' x-text='user.email'></span>
                                <div @click.outside="cancelEditingEmail">
                                    <input x-show="isEditingEmail" type="text" x-model="tempEmail"
                                        class="my-input" autocomplete="off" x-ref="emailInput"
                                        @keydown.enter="isEditingEmail = !isEditingEmail; saveEmail()"
                                        x-init="$watch('isEditingEmail', value => {
                                            if (value) {
                                                tempEmail = user.email
                                            }
                                        })">
                                    <span class="cursor-pointer opacity-5 hover:opacity-100"
                                        @click="isEditingEmail = !isEditingEmail; if (!isEditingEmail) saveEmail(); else $nextTick(() => $refs.emailInput.focus());">
                                        <i x-show="!isEditingEmail" class="fas fa-pencil"></i>
                                        <i x-show="isEditingEmail" class="fas fa-circle-check"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="others mt-4"></div>

                            <div class="flex gap-2 leading-10 font-bold">
                                <span>Tanggal bergabung
                                    :</span><span x-text='formattedJoinedDate'></span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function data() {
                return {
                    isEditingStatus: false,
                    isEditingFullname: false,
                    isEditingName: false,
                    isEditingBirthday: false,
                    isEditingGender: false,
                    isEditingStatusPernikahan: false,
                    isEditingOccupation: false,
                    isEditingEducation: false,
                    isEditingHp: false,
                    isEditingEmail: false,
                    isAlertShow: false,
                    user: @json(auth()->user()),
                    // data temp untuk mengembalikan data field ke semula jika klik outside 
                    tempStatus: '',
                    tempFullname: '',
                    tempName: '',
                    tempBirthday: '',
                    tempGender: '',
                    tempStatusPernikahan: '',
                    tempOccupation: '',
                    tempEducation: '',
                    tempHp: '',
                    tempEmail: '',

                    get formattedBirthday() {
                        return new Date(this.user.birthday).toLocaleDateString('id-ID', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });
                    },
                    get formattedJoinedDate() {
                        return new Date(this.user.created_at).toLocaleDateString('id-ID', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });
                    },
                    formatBirthdayForInput(birthday) {
                        const date = new Date(birthday);
                        const year = date.getFullYear();
                        const month = String(date.getMonth() + 1).padStart(2, '0');
                        const day = String(date.getDate()).padStart(2, '0');
                        return `${year}-${month}-${day}`;
                    },
                    updateUserData() {
                        axios.patch('{{ route('profile.update') }}',
                                this.user
                            )
                            .then(response => {
                                console.log(response.data.status);
                                this.isAlertShow = true
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    },
                    
                    uploadPhoto(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const formData = new FormData();
                                formData.append('photo', file);
                                axios.post('{{ route('profile.update_photo') }}', formData, {
                                        headers: {
                                            'Content-Type': 'multipart/form-data'
                                        }
                                    })
                                    .then(response => {
                                        if (response.data.imgPath) {
                                            // Ganti sumber gambar dengan jalur baru
                                            document.getElementById('profile-photo').src = response.data.imgPath;
                                        }

                                        // Update the user image with the new one
                                        this.user.img = response.data.imgPath;
                                        this.isAlertShow = true;


                                    })
                                    .catch(error => {
                                        console.error(error);
                                    });
                            }
                        },

                    saveFullname() {
                        this.user.fullname = this.tempFullname;
                        this.isEditingFullname = false;
                        this.updateUserData();
                    },
                    cancelEditingFullname() {
                        this.isEditingFullname = false;
                        this.tempFullname = this.user.fullname;
                    },
                    saveName() {
                        this.user.name = this.tempName;
                        this.isEditingName = false;
                        this.updateUserData();
                    },
                    cancelEditingName() {
                        this.isEditingName = false;
                        this.tempName = this.user.name;
                    },
                    saveGender() {
                        this.user.gender = this.tempGender;
                        this.isEditingGender = false;
                        this.updateUserData();
                    },
                    cancelEditingGender() {
                        this.isEditingGender = false;
                        this.tempGender = this.user.gender;
                    },
                    saveStatusPernikahan() {
                        this.user['status-pernikahan'] = this.tempStatusPernikahan;
                        this.isEditingStatusPernikahan = false;
                        this.updateUserData();
                    },
                    cancelEditingStatusPernikahan() {
                        this.isEditingStatusPernikahan = false;
                        this.tempStatusPernikahan = this.user['status-pernikahan'];
                    },

                    saveBirthday() {
                        this.user.birthday = this.tempBirthday;
                        this.isEditingBirthday = false;
                        this.updateUserData();
                    },
                    cancelEditingBirthday() {
                        this.isEditingBirthday = false;
                        this.tempBirthday = this.formatBirthdayForInput(this.user.birthday);
                    },

                    saveOccupation() {
                        this.user.occupation = this.tempOccupation;
                        this.isEditingOccupation = false;
                        this.updateUserData();
                    },
                    cancelEditingOccupation() {
                        this.isEditingOccupation = false;
                        this.tempOccupation = this.user.occupation;
                    },
                    saveEducation() {
                        this.user.education = this.tempEducation;
                        this.isEditingEducation = false;
                        this.updateUserData();
                    },
                    cancelEditingEducation() {
                        this.isEditingEducation = false;
                        this.tempEducation = this.user.education;
                    },
                    saveHp() {
                        this.user.hp = this.tempHp;
                        this.isEditingHp = false;
                        this.updateUserData();
                    },
                    cancelEditingHp() {
                        this.isEditingHp = false;
                        this.tempHp = this.user.hp;
                    },
                    saveEmail() {
                        this.user.email = this.tempEmail;
                        this.isEditingEmail = false;
                        this.updateUserData();
                    },
                    cancelEditingEmail() {
                        this.isEditingEmail = false;
                        this.tempEmail = this.user.email;
                    },
                    saveStatus() {
                        this.user.status = this.tempStatus;
                        this.isEditingStatus = false;
                        this.updateUserData();
                    },
                    cancelEditingStatus() {
                        this.isEditingStatus = false;
                        this.tempStatus = this.user.status;
                    },
                }
            }
        </script>
    @endpush
</x-app-layout>
