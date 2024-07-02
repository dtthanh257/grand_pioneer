import axios from "axios";
import { authHeader } from "@/services/base.service";
import { BASE_API_URL } from "@/helpers/base.api.url";

class UserService {
  async getData() {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/users",
      headers: authHeader(),
    });
  }
}
export default new UserService();
