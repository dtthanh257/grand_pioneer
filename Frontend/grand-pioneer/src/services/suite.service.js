import axios from "axios";
import { authHeader } from "@/services/base.service";
import { BASE_API_URL } from "@/helpers/base.api.url";

class SuiteService {
  async getData(vessel_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/vessels/" + vessel_id + "/suites",
    });
  }

  async getDataById(vessel_id, suite_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/vessels/" + vessel_id + "/suites/" + suite_id,
    });
  }

  async storeData(voyage, vessel_id) {
    // return await axios.post(, voyage, {
    //   headers: authHeader(),
    // });
    return await axios({
      method: "post",
      url: BASE_API_URL + "/vessels/" + vessel_id + "/suites",
      data: voyage,
      headers: authHeader(),
    });
  }

  async updateData(suite_id, vessel_id, voyage) {
    return await axios({
      method: "put",
      url: BASE_API_URL + "/vessels/" + vessel_id + "/suites/" + suite_id,
      voyage,
      headers: authHeader(),
    });
  }

  async deleteData(suite_id, vessel_id) {
    return await axios({
      method: "delete",
      url: BASE_API_URL + "/vessels/" + vessel_id + "/suites/" + suite_id,
      headers: authHeader(),
    });
  }
}

export default new SuiteService();
