import axios from "axios";
import { authHeader } from "@/services/base.service";
import { BASE_API_URL } from "@/helpers/base.api.url";

class VoyageService {
  async getData(vessel_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/vessels/" + vessel_id + "/voyages",
    });
  }

  async getDataById(vessel_id, voyage_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/vessels/" + vessel_id + "/voyages/" + voyage_id,
    });
  }

  async storeData(voyage, vessel_id) {
    return await axios.post(BASE_API_URL + "/vessels/" + vessel_id + "/voyages", voyage, {
      headers: authHeader(),
    });
  }

  async updateData(voyage_id, vessel_id, voyage) {
    return await axios({
      method: "put",
      url: BASE_API_URL + "/vessels/" + vessel_id + "/voyages/" + voyage_id,
      voyage,
      headers: authHeader(),
    });
  }

  async deleteData(voyage_id, vessel_id) {
    return await axios({
      method: "delete",
      url: BASE_API_URL + "/vessels/" + vessel_id + "/voyages/" + voyage_id,
      headers: authHeader(),
    });
  }
}

export default new VoyageService();
