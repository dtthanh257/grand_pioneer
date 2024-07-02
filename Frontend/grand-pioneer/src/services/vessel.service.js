import axios from "axios";
import { authHeader } from "@/services/base.service";
import { BASE_API_URL } from "@/helpers/base.api.url";

class VesselService {
  async getData() {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/vessels",
    });
  }

  async getDataById(vessel_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/vessels/" + vessel_id,
    });
  }

  async storeData(voyage) {
    return await axios.post(BASE_API_URL + "/vessels", voyage, {
      headers: authHeader(),
    });
  }

  async updateData(vessel_id, voyage) {
    return await axios({
      method: "put",
      url: BASE_API_URL + "/vessels/" + vessel_id,
      voyage,
      headers: authHeader(),
    });
  }

  async deleteData(vessel_id) {
    return await axios({
      method: "delete",
      url: BASE_API_URL + "/vessels/" + vessel_id,
      headers: authHeader(),
    });
  }
}

export default new VesselService();
