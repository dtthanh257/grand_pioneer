<template>
    <div class="career-view body-custom">
        <div class="flex-c items-center px-5">
            <PageLogo></PageLogo>
            <div class="flex-c gap-8 items-center">
                <div class="blue text-center">CAREER</div>
                <div class="blue text-center text-2xl">
                    JOIN OUR TEAM
                </div>
                <div class="blue text-center w-5/6 mb-8 ">Interested in a career with Essence Grand Cruise? Complete the
                    form
                    below
                    and we will reach out to you as opportunities arise.</div>
                <div class="flex-c gap-8 w-5/6 items-center mb-10">
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-3  gap-4">
                        <Combobox isV3="true" :white="false" fetchValue="TITLE"></Combobox>
                        <Input placeholder="FIRSTNAME"></Input>
                        <Input placeholder="LASTNAME"></Input>
                    </div>
                    <div class="flex-c w-full">
                        <Input placeholder="EMAIL"></Input>
                    </div>
                    <div class="flex-c items-center  min-w-fit">
                        <Button button_v="1" text="SEND"></Button>
                    </div>
                </div>


            </div>
        </div>
        <Menu></Menu>
        <Footer></Footer>
    </div>
</template>
<script>
import Footer from '@/components/Footer.vue';
import PageLogo from "@/components/PageLogo.vue";
import Combobox from "@/components/Combobox.vue";
import Input from "@/components/Input.vue"
import Button from "@/components/Button.vue"
import Menu from "@/components/Menu.vue";

export default {
    name: "CareerView",
    components: {
        Footer,
        PageLogo,
        Combobox,
        Input,
        Button,
        Menu
    }
}
</script>