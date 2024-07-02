<template>
  <div class="container mx-auto px-4 py-8 text-xs">
    <h1 class="text-2xl font-bold mb-4">Activities List</h1>

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
            <td class="border px-4 py-2">{{ user.role === 1 ? "Admin" : "User" }}</td>
            <td class="border px-4 py-2">{{ user.email }}</td>
            <td class="border px-4 py-2">{{ user.phone_number }}</td>
            <td class="border px-4 py-2">{{ formatDateTime(user.created_at) }}</td>
            <td class="border px-4 py-2">{{ formatDateTime(user.updated_at) }}</td>
            <td class="border px-4 py-2 sticky-col bg-white flex justify-center space-x-2">
              <button
                @click="editUser(user)"
                class="bg-blue-500 text-white px-2 py-1 rounded"
              >
                Edit
              </button>
              <button
                @click="deleteUser(user)"
                class="bg-red-500 text-white px-2 py-1 rounded"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import Admin from "@/services/admin.service";
export default {
  name: "ActivityPortal",
  data() {
    return {
      activites: [],
    };
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
    async getActivities() {
      const response = await Admin.getData();
      console.log(response);
    },
    editUser() {
      this.getUserData();
    },
    deleteUser(user) {
      if (confirm(`Are you sure you want to delete user: ${user.first_name} ${user.last_name}?`)) {
        this.users = this.users.filter((u) => u.id !== user.id);
      }
    },
  },
};
</script>

<style scoped>
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
</style>
