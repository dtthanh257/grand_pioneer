<template>
  <div class="container mx-auto px-4 py-8 text-xs">
    <div class="flex-r items-center mb-4 justify-between">
      <h1 class="text-2xl font-bold">User List</h1>
      <div
        class="flex-r font-semibold gap-2 items-center cursor-pointer"
        @click="openForm"
      >
        <div class="addBtn bg-contain"></div>
        Add new
      </div>
    </div>
    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
      <table
        class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative"
      >
        <thead>
          <tr class="text-left">
            <th class="py-2 px-3 sticky top-0 bg-gray-200">ID</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">First Name</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Last Name</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Address</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Gender</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Role</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Email</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Phone Number</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Created At</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Updated At</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200 sticky-col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="user in users"
            :key="user.id"
          >
            <td class="border px-4 py-2">{{ user.id }}</td>
            <td class="border px-4 py-2">{{ user.first_name }}</td>
            <td class="border px-4 py-2">{{ user.last_name }}</td>
            <td class="border px-4 py-2">{{ user.address }}</td>
            <td class="border px-4 py-2">{{ user.gender === 1 ? "Male" : "Female" }}</td>
            <td class="border px-4 py-2">{{ user.role === 0 ? "Admin" : "User" }}</td>
            <td class="border px-4 py-2">{{ user.email }}</td>
            <td class="border px-4 py-2">{{ user.phone_number }}</td>
            <td class="border px-4 py-2">{{ formatDateTime(user.created_at) }}</td>
            <td class="border px-4 py-2">{{ formatDateTime(user.updated_at) }}</td>
            <td class="border px-4 py-2 sticky-col bg-white flex justify-center space-x-2">
              <button
                @click="
                  openEditForm(
                    user.id,
                    user.first_name,
                    user.last_name,
                    user.email,
                    user.phone_number,
                    user.address,
                    user.gender,
                    user.role,
                    user.password,
                    user.password_confirmation
                  )
                "
                class="bg-blue-500 text-white px-2 py-1 rounded"
              >
                Edit
              </button>
              <button
                @click="deleteUser(user.id)"
                class="bg-red-500 text-white px-2 py-1 rounded"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div
      v-if="isFormOpen"
      class="fixed top-0 bottom-0 right-0 left-0 bg-black bg-opacity-50 z-10 flex items-center justify-center"
    >
      <div class="add-form bg-white rounded p-4">
        <h2 class="text-xl font-bold pb-2">Add New User</h2>
        <form
          @submit.prevent="addUser"
          class="flex flex-col justify-between"
        >
          <div class="grid grid-cols-2 gap-8">
            <div class="flex-r gap-2">
              <div class="mb-2 w-full">
                <label class="block w-full">First Name</label>
                <input
                  v-model="form.first_name"
                  type="text"
                  class="form-input"
                  style="width: 100%"
                />
              </div>
              <div class="mb-2 w-full">
                <label class="block w-full">Last Name</label>
                <input
                  v-model="form.last_name"
                  type="text"
                  class="form-input"
                  style="width: 100%"
                />
              </div>
            </div>
            <div class="flex-r gap-2">
              <div class="mb-2 w-full">
                <label class="block w-full">Email</label>
                <input
                  v-model="form.email"
                  type="email"
                  class="form-input"
                />
              </div>
              <div class="mb-2 w-full">
                <label class="block">Phone Number</label>
                <input
                  v-model="form.phone_number"
                  type="text"
                  class="form-input"
                />
              </div>
            </div>
          </div>
          <div class="grid grid-cols-2 gap-8">
            <div class="mb-2 w-full">
              <label class="block w-full">Address</label>
              <input
                v-model="form.address"
                type="text"
                class="form-input"
              />
            </div>
            <div class="flex-r gap-3">
              <div class="mb-2 flex-col flex">
                <label class="block mb-1">Gender</label>
                <div class="flex-r gap-3">
                  <div class="flex-r gap-1">
                    <input
                      type="radio"
                      name="gender"
                      value="0"
                      v-model="form.gender"
                    />
                    Male
                  </div>
                  <div class="flex-r gap-1">
                    <input
                      type="radio"
                      name="gender"
                      value="1"
                      v-model="form.gender"
                    />
                    Female
                  </div>
                  <div class="flex-r gap-1">
                    <input
                      type="radio"
                      name="gender"
                      value="2"
                      v-model="form.gender"
                    />
                    Other
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-2">
            <label class="block mb-1">Role</label>
            <div class="flex-r gap-3">
              <div class="flex-r gap-1">
                <input
                  type="radio"
                  name="role"
                  value="1"
                  v-model="form.role"
                />
                Customer
              </div>
              <div class="flex-r gap-1">
                <input
                  type="radio"
                  name="role"
                  value="0"
                  v-model="form.role"
                />
                Admin
              </div>
            </div>
          </div>
          <div class="grid grid-cols-2 gap-8">
            <div class="mb-2 w-full">
              <label class="block w-full">Password</label>
              <input
                v-model="form.password"
                type="password"
                class="form-input"
              />
            </div>
            <div class="mb-2 w-full">
              <label class="block w-full">Confirm password</label>
              <input
                v-model="form.password_confirmation"
                type="password"
                class="form-input"
              />
            </div>
          </div>

          <div class="flex-r">
            <button
              type="submit"
              class="bg-blue-500 text-white px-4 py-2 rounded"
            >
              Add User
            </button>
            <button
              type="button"
              @click="closeForm"
              class="bg-gray-500 text-white px-4 py-2 rounded ml-2"
            >
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
    <div
      v-if="isFormEditOpen"
      class="fixed top-0 bottom-0 right-0 left-0 bg-black bg-opacity-50 z-10 flex items-center justify-center"
    >
      <div class="add-form bg-white rounded p-4">
        <h2 class="text-xl font-bold pb-2">Edit User</h2>
        <form
          @submit.prevent="updateUser"
          class="flex flex-col justify-between"
        >
          <div class="grid grid-cols-2 gap-8">
            <div class="flex-r gap-2">
              <div class="mb-2 w-full">
                <label class="block w-full">First Name</label>
                <input
                  v-model="form_edit.first_name"
                  type="text"
                  class="form-input"
                  style="width: 100%"
                />
              </div>
              <div class="mb-2 w-full">
                <label class="block w-full">Last Name</label>
                <input
                  v-model="form_edit.last_name"
                  type="text"
                  class="form-input"
                  style="width: 100%"
                />
              </div>
            </div>
            <div class="flex-r gap-2">
              <div class="mb-2 w-full">
                <label class="block w-full">Email</label>
                <input
                  v-model="form_edit.email"
                  type="email"
                  class="form-input"
                />
              </div>
              <div class="mb-2 w-full">
                <label class="block">Phone Number</label>
                <input
                  v-model="form_edit.phone_number"
                  type="text"
                  class="form-input"
                />
              </div>
            </div>
          </div>
          <div class="grid grid-cols-2 gap-8">
            <div class="mb-2 w-full">
              <label class="block w-full">Address</label>
              <input
                v-model="form_edit.address"
                type="text"
                class="form-input"
              />
            </div>
            <div class="flex-r gap-3">
              <div class="mb-2 flex-col flex">
                <label class="block mb-1">Gender</label>
                <div class="flex-r gap-3">
                  <div class="flex-r gap-1">
                    <input
                      type="radio"
                      name="gender"
                      value="0"
                      v-model="form_edit.gender"
                    />
                    Male
                  </div>
                  <div class="flex-r gap-1">
                    <input
                      type="radio"
                      name="gender"
                      value="1"
                      v-model="form_edit.gender"
                    />
                    Female
                  </div>
                  <div class="flex-r gap-1">
                    <input
                      type="radio"
                      name="gender"
                      value="2"
                      v-model="form_edit.gender"
                    />
                    Other
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-2">
            <label class="block mb-1">Role</label>
            <div class="flex-r gap-3">
              <div class="flex-r gap-1">
                <input
                  type="radio"
                  name="role"
                  value="0"
                  v-model="form_edit.role"
                />
                Customer
              </div>
              <div class="flex-r gap-1">
                <input
                  type="radio"
                  name="role"
                  value="1"
                  v-model="form_edit.role"
                />
                Admin
              </div>
            </div>
          </div>
          <div class="flex-r">
            <button
              type="submit"
              @click="updateUser()"
              class="bg-blue-500 text-white px-4 py-2 rounded"
            >
              Update User
            </button>
            <button
              type="button"
              @click="closeForm"
              class="bg-gray-500 text-white px-4 py-2 rounded ml-2"
            >
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import UserService from "@/services/user.service";
import AuthenticationService from "@/services/auth.service";
import Admin from "@/services/admin.service";
export default {
  name: "UserPortal",
  data() {
    return {
      users: [],
      isFormOpen: false,
      isFormEditOpen: false,
      form: {
        first_name: "",
        last_name: "",
        address: "",
        gender: 1,
        role: 1,
        email: "",
        phone_number: "",
        password: "",
        password_confirmation: "",
      },
      form_edit: {
        first_name: "",
        last_name: "",
        address: "",
        gender: 1,
        role: 2,
        email: "",
        phone_number: "",
      },
      updateId: 0,
    };
  },
  mounted() {
    this.getUserData();
  },
  methods: {
    formatDateTime(datetime) {
      const options = {
        year: "numeric",
        month: "short",
        day: "numeric",
        hour: "numeric",
        minute: "numeric",
      };
      return new Date(datetime).toLocaleDateString("en-US", options);
    },
    async getUserData() {
      await UserService.getData()
        .then((res) => {
          this.users = res.data.data.users;
        })
        .catch(() => {
          localStorage.removeItem("jwt_token");
          localStorage.removeItem("role");
          window.location.reload();
        });
    },
    editUser() {
      this.getUserData();
    },
    openForm() {
      this.isFormOpen = true;
    },
    openEditForm(id, first_name, last_name, email, phone_number, address, gender, role) {
      this.isFormEditOpen = true;
      this.updateId = id;
      this.form_edit.first_name = first_name;
      this.form_edit.last_name = last_name;
      this.form_edit.email = email;
      this.form_edit.phone_number = phone_number;
      this.form_edit.address = address;
      this.form_edit.gender = gender;
      this.form_edit.role = role;
      console.log(this.form_edit);
    },
    closeForm() {
      this.isFormOpen = false;
      this.isFormEditOpen = false;
      console.log(this.form);
    },
    async addUser() {
      try {
        const res = await AuthenticationService.register(this.form);
        this.getUserData();
        alert("Add user successfully");
        console.log(res);
        this.closeForm();
      } catch (error) {
        alert(error.message);
        this.closeForm();
      }
    },
    async deleteUser(id) {
      try {
        await Admin.deleteUser(id);
        this.getUserData();
        alert("Delete Successfully");
      } catch (error) {
        console.log(error);
        alert("Delete Fail");
      }
    },
    async updateUser(id, data) {
      try {
        id = this.updateId;
        data = this.form_edit;
        await Admin.updateUser(id, data);
        this.getUserData();
        alert("Update successfully");
      } catch (error) {
        alert(error);
      }
    },
  },
};
</script>
<style>
table th,
td {
  white-space: nowrap;
}

.sticky-col {
  position: -webkit-sticky;
  position: sticky;
  right: 0;
  z-index: 2;
  width: fit-content;
}

thead .sticky-col {
  z-index: 5;
}

.addBtn {
  height: 24px;
  width: 24px;
  background-image: url(./../../../assets/add-icon.png);
}

.add-form {
  height: fit-content;
  max-height: 80%;
  width: 70%;
}

.form-input {
  border: 1px solid black;
  height: 24px;
  width: 100%;
  padding: 4px;
  margin-bottom: 8px;
}

label {
  font-weight: 500;
}
</style>
