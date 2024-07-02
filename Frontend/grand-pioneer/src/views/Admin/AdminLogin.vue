<template>
  <div
    class="admin-login body-custom"
    style="max-width: 1440px"
  >
    <section class="admin-login dark:bg-gray-900">
      <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div
          class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700"
        >
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1
              class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white"
            >
              Sign in to your account
            </h1>
            <form @submit.prevent="login">
              <div class="mb-4">
                <label
                  for="email"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                  >Your username</label
                >
                <input
                  type="text"
                  v-model="loginForm.username"
                  id="email"
                  name="email"
                  class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="name@company.com"
                  required
                />
              </div>
              <div class="mb-4">
                <label
                  for="password"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >
                  Password
                </label>
                <input
                  type="password"
                  v-model="loginForm.password"
                  id="password"
                  name="password"
                  placeholder="••••••••"
                  class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  required
                />
              </div>
              <button
                type="submit"
                class="w-full blue login-btn bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
              >
                Sign in
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import AuthenticationService from "@/services/auth.service";
import { useRoute, useRouter } from "vue-router";

export default {
  name: "AdminLogin",
  data() {
    return {
      loginForm: {
        username: "",
        password: "",
      },
    };
  },
  setup() {
    const route = useRoute();
    const router = useRouter();

    const isActive = (name) => {
      return route.name == name;
    };

    const navigateTo = (path) => {
      router.push(path);
    };

    return {
      isActive,
      navigateTo,
    };
  },
  methods: {
    async login() {
      const LoginForm = {
        email: this.loginForm.username,
        password: this.loginForm.password,
      };
      try {
        await AuthenticationService.login(LoginForm).then((response) => {
          localStorage.setItem("jwt_token", response.data.data.token);
          localStorage.setItem("role", response.data.data.user.role);
          this.redirecrtToAdminDashBoard();
          console.log("Success Login");
        });
      } catch (error) {
        // Xử lý lỗi đăng nhập
        alert(error);
      }
    },
    redirecrtToAdminDashBoard() {
      this.$router.push("/admin1970/dashboard");
    },
  },
};
</script>

<style>
.admin-login {
  height: 100vh;
  width: 100%;
  background-color: var(--blue-color);
}

.login-btn {
  border: 1px solid var(--blue-color);
}

.login-btn:hover {
  background-color: var(--blue-color);
  color: var(--yellow-color);
}

.login-btn:active {
  background-color: #555;
}
</style>
