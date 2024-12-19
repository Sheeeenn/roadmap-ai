<template>
  <div class="dashboard-page">
      <div class="container mt-5">
        <div class="row align-items-center">
            <div class="title col-lg-12"> Your Roadmaps </div>
            <div class="subtitle col-lg-12">
              Keep up the great work! You're on track to achieving your goals.
            </div>
            
            <!-- Conditional Rendering -->
            <div v-if="roadmaps.length === 0" class="content col-lg-12">
              You don't have any roadmaps yet! Start your learning journey by choosing a
              topic and creating your first personalized roadmap.
              <br>
              <button @click="createRoadmap" class="createbtn col-lg-12">
                CREATE A NEW ROADMAP
              </button>
            </div>
            
            <div v-else class="content2 col-lg-12">
              <button @click="createRoadmap" class="card-btn" style="border: none; padding: 0; background: none; margin-bottom: 20px; ">
                    <div class="card" style="width: 410px; cursor: pointer; ">
                        <div class="card-body">
                            <img src="/src/assets/plus.png" alt="Roadmap" class="img-fluid" />
                            <h5 class="card-title"> <b> Create Roadmap </b> </h5>
                        </div>
                    </div>
              </button>
              <!-- Render Roadmap Cards -->
              <div class="row">
                <div v-for="roadmap in roadmaps" :key="roadmap.id" class="col-md-4" style="margin-top: 1rem;">
                  <div class="card" @click="sendData(roadmap.id)" style="width: 100%; height: 220px; cursor: pointer;">
                    <div class="card-body">
                      <i class="fa-solid fa-diagram-project" style="color: #00bcd4; font-size: 44px;"></i>
                      <h5 class="card-title">{{ roadmap.mainTopic }}</h5>
                      <p class="card-text">Roadmap ID: {{ roadmap.id }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

        </div>
      </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
      return {
        RoadmapID: "",
        roadmaps: [] 
      };
  },

  async mounted() {
    await this.getData();
    await this.fetchSessionData();
  },
  methods: {
    async getData() {
      try {
        axios.defaults.withCredentials = true;
        const response = await axios.get('https://guiriba.com/API/user');
        if(response.data.status == "success") {
            console.log('Response:', response.data);
        } else if(response.data.status == "loggedout"){
            alert("Please Log In first.")
            this.$router.push('/login');
        }
      } catch (error) {
        console.error('There was an error!', error);
      }
    },

    async sendData(test) {
      try {
        axios.defaults.withCredentials = true;
        console.log("Roadmap:",test);
        const response = await axios.post('https://guiriba.com/API/Fuckyou2', {
          RoadmapID: test,
        });
        console.log('Response:', response.data);
        if(response.data.status == "success") {
            this.$router.push('/roadmap');
        } else {
            console.log("BURAT");
        }
      } catch (error) {
        console.error('There was an error!', error);
      }
    },
    
    
    async fetchSessionData() {
        try {
            axios.defaults.withCredentials = true;

            const response = await axios.get('https://guiriba.com/API/Fuckyou');
            
            // Check if response.data is not empty or undefined
            if (response.data && response.data.length > 0) {
                console.log('Response:', response.data[0].MainTopic);
                this.processRoadmaps(response.data);

                if (this.roadmaps.length > 0) {
                    console.log('Roadmaps loaded:', this.roadmaps);
                }
            }
        } catch (error) {
            console.error('There was an error!', error);
        }
    },
    processRoadmaps(data) {
        // Check if data is valid, is an array, and has values
        if (!data || !Array.isArray(data) || data.length === 0) {
            console.error('Invalid data:', data); // Log the invalid data for debugging
            return; // Exit the function if data is null, undefined, or not an array
        }

        // Map the data to the desired format and update the roadmaps array
        this.roadmaps = data.map((item) => ({
            id: item.RoadmapID, // Replace with actual key for ID
            mainTopic: item.MainTopic // Replace with actual key for Main Topic
        }));
    },
    createRoadmap() {
        this.$router.push('/home');
    }
  }
};
</script>

<style scoped>
@import './DashboardPage.css';  
</style>

  