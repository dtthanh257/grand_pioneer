<template>
  <div class="about-us">
    <div
      class="h-40 md:h-96 lg:h-screen w-full bg-cover mb-8"
      :style="{ backgroundImage: `url(${require('@/assets/home-img.jpg')})` }"
    >
      <Blur class="hidden lg:block"></Blur>
      <div class="page-contain flex-c hidden lg:flex">
        <PageLogo :logo-type="3"></PageLogo>
        <div class="page-heading__title uppercase">
          <div class="saol-light flex-r-center white text-wrap text-center">ABOUT US</div>
          <div
            class="text-white items-center justify-center w-full flex text-xs md:text-base mt-5 mb-4"
          >
            <div class="w-3/4 text-center">
              Essence Grand Cruise - the greenest, safest and the most modern cruise in Halong Bay -
              the masterpiece created by Vietnamese strength and intelligence.
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="grid grid-cols-1 md:grid-cols-2 px-5 p-0 gap-10 body-custom mb-10"
      style="max-width: 1440px"
    >
      <div class="flex-c">
        <div class="blue text-2xl text-center md:text-start mb-8">ABOUT US</div>
        <div class="blue flex-c">
          <div class="section flex-c">
            <div class="font-medium">Safe - putting people at the centre</div>
            <div class="blue">
              With a focus on putting people at the centre, Essence Grand Halong Bay Cruises
              consistently ensures the utmost safety for passengers and crew. Essence Grand Halong
              Bay Cruises holds the VRSB certificate to operate in all coastal areas of Vietnam,
              making it the first green cruise in Vietnam to comply with international environmental
              standards and provide overnight stays in Halong Bay, Lan Ha, and conduct offshore
              trips to places like Cat Ba, Danang and Nha Trang… The cruise uses a water supply
              system for all onboard activities that is 100% guaranteed through filtration and
              softening. Thus, the water supplied onboard meets sanitation and safety standards. The
              heat pump system is also used to provide hot water, ensuring a constant supply of hot
              water for daily use and the warm-water swimming pool. This system uses cool gas to
              heat water, saving 75% of the electricity consumption required for hot water
              production compared to traditional electrical methods. Additionally, it optimises when
              placed in the engine room to absorb heat from other devices, maintaining an optimal
              engine room temperature, prolonging the lifespan of equipment, and providing a
              comfortable working environment for crew members. The cruise's electrical system is
              supplied through an isolation transformer that minimises electrical surges, ensuring
              maximum safety for users. The use of 100% LED lights reduces electricity consumption.
              Furthermore, the main engine and generator are genuine products from YANMAR (Japan)
              and meet international emission standards for NOX concentration, as regulated by IMO
              and certified by NK (Japan) and VR (Vietnam).
            </div>
            <div class="blue">
              Passengers can have complete confidence in the cruise's fire protection and rescue
              systems, which have been inspected and approved by the fire department, ensuring
              safety for both passengers and crew.
            </div>
            <div class="blue">
              In addition, the bow thruster system uses variable frequency control, remote control
              from the helm and ensures safety and flexibility in areas with numerous ship
              activities.
            </div>
            <div class="blue">
              The double-hull technology and the two-level ship structure ensure maximum safety in
              case of shipwreck. Essence Grand Halong Bay Cruise I is the only cruise in Halong Bay
              equipped with two lifeboats with adequate supplies, including flashlights, and
              distress signals, ensuring the highest survival capacity in emergencies. Moreover, the
              cruise ship is also equipped with 12 self-inflating life rafts, used in case of ship
              sinking.
            </div>
          </div>
        </div>
      </div>
      <div class="blue flex-c">
        <div class="section">
          <div class="font-medium">
            ESSENCE GRAND HALONG BAY CRUISE - THE FIRST SUPERCRUISE ON HALONG BAY BASED ON
            INTERNATIONAL STANDARDS
          </div>
          <div class="blue">
            Invested by the Viet Thuan Group, a leading company in the inland waterway and
            international maritime transportation, in collaboration with the Halong Shipbuilding
            Company, Essence Grand Halong Bay Cruise proudly presents itself as the first green,
            safe, and modern super cruise ship in the Halong Bay heritage site. Vision: Essence
            Grand Halong Bay Cruise aspires to advance beach tourism in Vietnam to international
            standards and explore unique heritage sea routes worldwide. Mission: Essence Grand
            Halong Bay Cruise assumes a pioneering role in eco-friendly resort trends, aiming to
            protect the heritage of Vietnam's Sea.
          </div>
        </div>
        <div class="section flex-c">
          <div class="font-medium">The first green cruise on Vietnam travel map</div>
          <div class="blue">
            With a mission to preserve natural heritage and promote sustainable tourism, Essence
            Grand Halong Bay Cruises introduced the first eco-friendly cruise in Vietnam. The super
            cruise is equipped with a Chiller air conditioning system, manufactured by Daikin in
            Japan, meeting the standards of 5-6 star international super cruises. Unlike traditional
            air conditioning systems that use gas to cool and directly release hot air into the
            environment, the Chiller system uses a cooling medium (water circulated through the
            spaces requiring cooling) with seawater as the heat dissipation medium. Furthermore, the
            cruise is equipped with a 15ppm oil-water separator system from HAN YOUNG (South Korea)
            certified by KR (South Korea) and VR (Vietnam), ensuring the treatment of oil in
            wastewater meets international standards. This equipment separates oil and water,
            storing dirty oil for processing while releasing clean water into the environment.
          </div>
          <div class="blue">
            Essence Grand Halong Bay Cruise I is the only cruise on Halong Bay using premium paint
            from International Paint (Netherlands), with an investment value three to four times
            higher than conventional paint. This environmentally-friendly paint has anti-fouling
            capabilities through the self-polishing method, eliminating the use of harmful chemicals
            discharged into the water environment, and it is approved by developed countries and
            IMO. Additionally, the paint application process adheres to the PSPC (Performance
            Standard for Protective Coatings) standards, extending the paint's durability for over
            15 years, protecting the ship's hull and internal steel structures from seawater
            corrosion, thus increasing the cruise's lifespan, reducing the need for repainting,
            minimising the discharge of old paint into the environment, and contributing to the
            protection of the marine and land environments around shipyards.
          </div>
          <div class="blue">
            The paint used for freshwater tanks is non-hazardous to human health.Not limited to the
            ship's hardware, the green approach is also evident in the choice of interior materials
            and equipment. All furnishings are crafted from plantation timber instead of the
            unsustainable harvest of old-growth forests, reducing environmental harm. The ship's
            deck is made from modified bamboo, an eco-friendly material. Various onboard items such
            as disposable items and water bottles are made from recyclable materials.
          </div>
        </div>
        <div class="section flex-c">
          <div class="font-medium">The first green cruise on Vietnam travel map</div>
          <div class="blue">
            In addition to international safety and technical standards, Essence Grand Halong Bay
            Cruise I boasts the luxury and modern aesthetics of a state-of-the-art supercruise,
            offering a more spacious and beautiful design compared to international cruises
            departing from Indonesia, Singapore, and beyond to Vietnam. This design provides
            passengers with a complete view to appreciate the beauty of the Halong Bay heritage site
            and other beautiful coastal areas in Vietnam. Furthermore, Essence Grand Cruises is
            equipped with a Building Management System (BMS) for more efficient operation
            management, reducing the number of system operation staff. It automatically adjusts
            temperature and cooling space, saving energy consumption for the air conditioning
            system. This guarantees absolute safety, saving over 30% on electricity, and minimising
            greenhouse gas emissions when gas-based air conditioning systems require repairs.
          </div>
          <div class="blue">
            Proudly the most luxurious super cruise ship in Halong Bay, Essence Grand Halong Bay
            Cruise stands out with a length of 110 metres. The main deck covers an area of nearly
            2,000 square metres and offers 55 bay-view rooms, Owner Suites with room sizes of up to
            150 square , and a private outdoor space of 200 square metres with a hot tub, sunbathing
            chairs, and a helipad. It's not just a resort space; Essence Grand Halong Bay Cruise is
            an integrated super cruise ship with various entertainment and function areas:
            restaurants, bars & lounges, karaoke, spa, 3D golf course, wine & cigar lounge, fitness
            centre, and more.
          </div>
        </div>
      </div>
    </div>
    <Menu></Menu>
    <Footer></Footer>
  </div>
</template>
<script>
import Blur from "@/components/Blur.vue";
import Footer from "@/components/Footer.vue";
import PageLogo from "@/components/PageLogo.vue";
import Menu from "@/components/Menu.vue";

export default {
  name: "AboutUs",
  components: {
    Blur,
    Footer,
    PageLogo,
    Menu,
  },
};
</script>
