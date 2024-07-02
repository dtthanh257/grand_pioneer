<template>
  <div class="footer">
    <div class="flex flex-row justify-center body-custom w-full px-5">
      <PageLogo
        :logo-type="3"
        class="mt-8 mb-14"
      ></PageLogo>
    </div>
    <div
      class="grid grid-cols-2 lg:grid-cols-3 p-0 body-custom w-full px-5"
      style="max-width: 1440px"
    >
      <div class="flex flex-col">
        <div class="text-sm text-white mb-4">GRAND PIONEERS</div>
        <div class="text-xs text-white py-2 flex gap-1">Contact us</div>
        <div class="text-xs text-white py-2 flex gap-1">About us</div>
        <div class="text-xs text-white py-2 flex gap-1">Safety policy</div>
        <div class="text-xs text-white py-2 flex gap-1">Cancellation policy</div>
        <div class="text-xs text-white py-2 flex gap-1">Cereer</div>
      </div>
      <div class="flex flex-col">
        <div class="text-sm text-white mb-4">Contact Us</div>
        <div class="text-xs text-white py-2 flex gap-1 items-center">
          <div class="mobie-icon icon h-8 w-8"></div>
          0376589368
        </div>
        <div class="text-xs text-white py-2 flex gap-1 items-center">
          <div class="phone-icon icon h-8 w-8"></div>
          02438389368
        </div>
        <div class="text-xs text-white py-2 flex gap-1 items-center">
          <div class="mail-icon icon h-8 w-8"></div>
          info@essencecruises.vn
        </div>
      </div>

      <div class="flex-col hidden lg:flex">
        <div class="text-sm text-white mb-4">Follow Us</div>
        <div class="flex flex-col">
          <div class="text-xs text-white py-2 flex items-center">
            <div class="tripod-icon icon h-8 w-8"></div>
          </div>
          <div class="text-xs text-white py-2 flex items-center">
            <div class="fb-icon icon h-8 w-8"></div>
          </div>
          <div class="text-xs text-white py-2 flex items-center">
            <div class="tiktok-icon icon h-8 w-8"></div>
          </div>
          <div class="text-xs text-white py-2 flex items-center">
            <div class="ytb-icon icon h-8 w-8"></div>
          </div>
          <div class="text-xs text-white py-2 flex items-center">
            <div class="ins-icon icon h-8 w-8"></div>
          </div>
        </div>
      </div>

      <!-- <div class="flex-c">
        <div class="footer-title white">Stay Connect</div>
        <div style="position: relative">
          <input
            type=" text"
            placeholder="Enter your email"
          />
          <div class="enter-arrow icon"></div>
        </div>
      </div> -->
    </div>
    <div
      class="flex flex-col my-8 justify-center lg:mt-0 w-full pb-20 px-5 lg:hidden"
      style="max-width: 1440px"
    >
      <div class="text-sm text-white mb-4">Follow Us</div>
      <div class="flex flex-row justify-between">
        <div class="text-xs text-white py-2 flex items-center">
          <div class="tripod-icon icon h-8 w-8"></div>
        </div>
        <div class="text-xs text-white py-2 flex items-center">
          <div class="fb-icon icon h-8 w-8"></div>
        </div>
        <div class="text-xs text-white py-2 flex items-center">
          <div class="tiktok-icon icon h-8 w-8"></div>
        </div>
        <div class="text-xs text-white py-2 flex items-center">
          <div class="ytb-icon icon h-8 w-8"></div>
        </div>
        <div class="text-xs text-white py-2 flex items-center">
          <div class="ins-icon icon h-8 w-8"></div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import PageLogo from "@/components/PageLogo.vue";
const Footer = {
  name: "Footer",
  components: {
    PageLogo,
  },
};
export default Footer;
</script>
