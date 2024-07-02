import { BASE_API_URL } from "@/helpers/base.api.url";
import axios from "axios";

class AuthenticationService {
  login(user) {
    return axios.post(BASE_API_URL + "/auth/login", user);
  }

  register(user) {
    return axios.post(BASE_API_URL + "/auth/register", user);
  }
}

export default new AuthenticationService();
