<dialog id="modalCategoryLabel" class="modal" x-data="categoryLabelCrud()">
    <div class="modal-box w-11/12 max-w-5xl">
        <h3 class="font-bold text-xl md:text-2xl mb-4">Label Kategori</h3>

        <!-- Form Tambah -->
        <div class="flex gap-2 mb-4">
            <input type="text" x-model="newName" placeholder="Nama label" class="input input-bordered w-full" />
            <button @click="create()" class="btn btn-primary">Tambah</button>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="w-full border">
                <thead>
                    <tr class="text-left border-b [&>th]:p-2">
                        <th class="text-center w-12">No</th>
                        <th>Nama</th>
                        <th class="text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="(item, index) in items" :key="item.id">
                        <tr class="border-b [&>td]:p-2">
                            <td class="text-center" x-text="index + 1"></td>
                            <td>
                                <template x-if="editId !== item.id">
                                    <span x-text="item.name"></span>
                                </template>
                                <template x-if="editId === item.id">
                                    <input type="text" x-model="editName" class="input input-bordered w-full" />
                                </template>
                            </td>
                            <td class="flex">
                                <!-- Tombol edit/simpan -->
                                <button x-show="editId !== item.id" @click="startEdit(item)"
                                    class="btn btn-xs btn-warning">Edit</button>
                                <button x-show="editId === item.id" @click="update(item.id)"
                                    class="btn btn-xs btn-success">Simpan</button>

                                <!-- Tombol hapus -->
                                <button @click="destroy(item.id)" class="btn btn-xs btn-error ml-1">Hapus</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
@push('scripts')
    <script>
        function categoryLabelCrud() {
            return {
                items: @json(collect($category_labels)->map(fn($n, $id) => ['id' => $id, 'name' => $n])->values()),
                newName: '',
                editId: null,
                editName: '',

                async reloadDropdown() {
                    let res = await fetch("/admin/category-labels", {
                        headers: {
                            "Accept": "application/json"
                        }
                    });
                    let data = await res.json();
                    let select = document.getElementById("category_label_id");
                    if (select) {
                        select.innerHTML = "";
                        data.forEach(item => {
                            let opt = document.createElement("option");
                            opt.value = item.id;
                            opt.textContent = item.name;
                            select.appendChild(opt);
                        });
                    }
                },

                async create() {
                    if (!this.newName) return;
                    let res = await fetch("{{ route('category-labels.store') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            name: this.newName
                        })
                    });

                    if (res.ok) {
                        let data = await res.json();
                        this.items.push(data);
                        this.newName = '';
                        await this.reloadDropdown();
                    } else {
                        let err = await res.json();
                        alert(err.message || Object.values(err.errors).join("\n"));
                    }
                },

                startEdit(item) {
                    this.editId = item.id;
                    this.editName = item.name;
                },

                async update(id) {
                    let res = await fetch(`/admin/category-labels/${id}`, {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            name: this.editName
                        })
                    });

                    if (res.ok) {
                        let data = await res.json();
                        let idx = this.items.findIndex(i => i.id === id);
                        this.items[idx].name = data.name;
                        await this.reloadDropdown();
                        this.editId = null;
                        this.editName = '';
                    } else {
                        let err = await res.json();
                        alert(err.message || Object.values(err.errors).join("\n"));
                    }
                },


                async destroy(id) {
                    if (!confirm("Yakin hapus?")) return;

                    let res = await fetch(`/admin/category-labels/${id}`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    });

                    if (res.ok) {
                        let data = await res.json();
                        if (data.success) {
                            this.items = this.items.filter(i => i.id !== id);
                            await this.reloadDropdown();
                        } else {
                            alert(data.message);
                        }
                    } else {
                        let err = await res.json();
                        alert(err.message || "Terjadi kesalahan saat menghapus.");
                    }
                }

            }
        }
    </script>
@endpush
