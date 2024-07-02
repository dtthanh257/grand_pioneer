import axios from "axios";
import { authHeader } from "@/services/base.service";
import { BASE_API_URL } from "@/helpers/base.api.url";

class ServiceMetadataService {
  async getData(service_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/services/" + service_id + "/service-metadata",
    });
  }

  async getDataById(service_id, service_metadata_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/services/" + service_id + "/service-metadata/" + service_metadata_id,
    });
  }

  async storeData(service_id, image_link) {
    return await axios.post(
      BASE_API_URL + "/services/" + service_id + "/service-metadata",
      { image_link: image_link },
      {
        headers: authHeader(),
      }
    );
  }

  async updateData(service_metadata_id, service_id, voyage) {
    return await axios({
      method: "put",
      url: BASE_API_URL + "/services/" + service_id + "/service-metadata/" + service_metadata_id,
      voyage,
      headers: authHeader(),
    });
  }

  async deleteData(service_metadata_id, service_id) {
    return await axios({
      method: "delete",
      url: BASE_API_URL + "/services/" + service_id + "/service-metadata/" + service_metadata_id,
      headers: authHeader(),
    });
  }
}

export default new ServiceMetadataService();
