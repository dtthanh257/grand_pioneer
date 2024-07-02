import axios from "axios";
import { authHeader } from "@/services/base.service";
import { BASE_API_URL } from "@/helpers/base.api.url";

class VesselServiceClass {
  async getData(vessel_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/vessels/" + vessel_id + "/services",
    });
  }

  async getDataById(vessel_id, suite_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/vessels/" + vessel_id + "/services/" + suite_id,
    });
  }

  async storeData(voyage, vessel_id) {
    return await axios.post(BASE_API_URL + "/vessels/" + vessel_id + "/services", voyage, {
      headers: authHeader(),
    });
  }

  async updateData(suite_id, vessel_id, voyage) {
    return await axios({
      method: "put",
      url: BASE_API_URL + "/vessels/" + vessel_id + "/services/" + suite_id,
      voyage,
      headers: authHeader(),
    });
  }

  async deleteData(suite_id, vessel_id) {
    return await axios({
      method: "delete",
      url: BASE_API_URL + "/vessels/" + vessel_id + "/services/" + suite_id,
      headers: authHeader(),
    });
  }
}

export default new VesselServiceClass();
