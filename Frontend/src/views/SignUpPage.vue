<template>
    <div class="landing-page">
        <div class="container">
            <div class="row align-items-center pb-5">
                <!-- Column 1: Image -->
                <div class="col-lg-5 mt-4">
                    <img src="/src/assets/roadmap.png" alt="Roadmap" class="img-fluid roadmapImg" />
                </div>

                <!-- Column 2: Title, Subtitle, and Prompt Bar -->

                <div class="col-lg-7">
                    <h1 class="title mb-4">Create an account</h1>
                    <p class="subtitle mb-4">Already have an account? <span class="loginLink" @click="goToLogin">Log
                            in</span></p>
                    <form @submit.prevent="submitData">
                        <!-- Username -->
                        <div class="search-container">
                            <input type="text" class="search-input" v-model="username" placeholder="  Username" />
                        </div>

                        <!-- Email -->
                        <div class="search-container">
                            <input type="text" class="search-input" v-model="email" placeholder="  Email" />
                        </div>

                        <!-- Password -->
                        <div class="search-container">
                            <input type="password" class="search-input" v-model="password" placeholder="  Password" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="search-container">
                            <input type="password" class="search-input" v-model="conf_pass"
                                placeholder="  Confirm Password" />
                        </div>

                        Verification Code
                        <div class="verification-container">
                            <label class="checkbox-label">
                                <input type="checkbox" v-model="isChecked" class="checkbox-custom" @change="isChecked ? submitEmail() : null"/>
                                Send Verification Code
                            </label>
                            <input type="text" v-model="verificationCode" placeholder="Enter Verification Code"
                                :disabled="!isChecked" class="verification-input"/>
                        </div>

                        <button class="loginBtn" type="submit">CREATE ACCOUNT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'LandingPage',
    data() {
        return {
            isChecked: false,
            username: '',
            email: '',
            password: '',
            conf_pass: '',
            confirmpassword: '',
            verificationCode: '',
            verificationSent: ''
        };
    },
    methods: {
        goToLogin() {
            this.$router.push('/login');
        },
        async submitData() {
            if(this.isChecked) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (emailRegex.test(this.email)) {
                    if(this.verificationCode == this.verificationSent){
                        try {
                            axios.defaults.withCredentials = true;

                            const response = await axios.post('https://guiriba.com/API/register', {
                                username: this.username,
                                email: this.email,
                                password: this.password,
                                conf_pass: this.conf_pass
                                //verificationCode: this.verificationCode
                            });
                            if(response.data.status == "success") {
                                this.$router.push('/login');
                            } else {
                                console.log("BURAT");
                            } 
                            console.log('Response:', response.data);
                        } catch (error) {
                            console.error('There was an error!', error);
                        }
                    } else {
                        alert("Verification code doesn't match");
                    }
                } else {
                    alert("Enter a valid Email.");
                }

            } else {
                    alert("Please verify your account first.");
            }
        },
        async submitEmail() {
            try {
                axios.defaults.withCredentials = true;
                const response = await axios.post('https://guiriba.com/API/verification', {
                    email: this.email,
                    //verificationCode: this.verificationCode
                });
                if(response.data.status == "success") {
                    console.log(response.data)
                    this.verificationSent = response.data.VCode;
                }
            } catch (error) {
                if (error.response) {
                console.error('Error response:', error.response.data);
                console.error('Status:', error.response.status);
                } else if (error.request) {
                console.error('No response received:', error.request);
                } else {
                console.error('Error setting up request:', error.message);
                }
            }
        },
    }
};

</script>

<style scoped>
@import './SignUpPage.css';


html,
body,
.landing-page {
    height: 100%;
    margin: 0;
}

.loginBtn {
    background: linear-gradient(#30D6F3, #2EBBD4);
    border: none;
    color: white;
    padding: 15px;
    width: 100%;
    text-align: center;
    border-radius: 30px;
    font-size: 18px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.loginBtn:hover {
    background: linear-gradient(90deg, #2EBBD4, #30D6F3);
}
</style>