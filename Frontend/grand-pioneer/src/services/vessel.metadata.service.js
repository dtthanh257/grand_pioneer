import axios from "axios";
import { authHeader } from "@/services/base.service";
import { BASE_API_URL } from "@/helpers/base.api.url";

class VesselMetadataService {
  async getData(vessel_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/vessels/" + vessel_id + "/vessel-metadata",
    });
  }

  async getDataById(vessel_id, vessel_metadata_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/vessels/" + vessel_id + "/vessel-metadata/" + vessel_metadata_id,
    });
  }

  async storeData(vessel_id, image_link) {
    return await axios.post(
      BASE_API_URL + "/vessels/" + vessel_id + "/vessel-metadata",
      { image_link: image_link },
      {
        headers: authHeader(),
      }
    );
  }

  async updateData(vessel_metadata_id, vessel_id, voyage) {
    return await axios({
      method: "put",
      url: BASE_API_URL + "/vessels/" + vessel_id + "/vessel-metadata/" + vessel_metadata_id,
      voyage,
      headers: authHeader(),
    });
  }

  async deleteData(vessel_metadata_id, vessel_id) {
    return await axios({
      method: "delete",
      url: BASE_API_URL + "/vessels/" + vessel_id + "/vessel-metadata/" + vessel_metadata_id,
      headers: authHeader(),
    });
  }
}

export default new VesselMetadataService();
