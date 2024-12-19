<template>
  <div class="dashboard-page">
    <div class="container mt-5">
      <div class="row align-items-center">
        <!-- Display MainTopic once at the top -->
        <div class="main-topic-title col-lg-12 mb-4">
          <h2>{{ steps.length ? steps[0].MainTopic : "Loading Main Topic..." }}<strong> Roadmap</strong></h2>
        </div>
      </div>
      <div class="roadmap">
        <!-- Render each step -->
        <div v-for="(step, index) in steps" :key="index" class="roadmap-step">
          <div class="step-box">
            <p class="topic"><strong></strong> {{ step.Topic }}</p>
            <!-- First arrow after Topic -->
            <div class="arrow">↓</div>
            
            <!-- SubTopics in a row -->
            <div class="subtopics-row">
              <div class="subtopic-col">
                <p><strong></strong> {{ step.SubTopic1 }}</p>
              </div>
              <div class="separator"><-></div>
              <div class="subtopic-col">
                <p><strong></strong> {{ step.SubTopic2 }}</p>
              </div>
            </div>
            <!-- Second arrow after SubTopics -->
            <div class="arrow">↓</div>
            
            <!-- Link -->
            <p class="link">
              <strong></strong> <a :href="step.Link" target="_blank">{{ step.Link }}</a>
            </p>
            <!-- Third arrow after Link (only if not the last step) -->
            <div v-if="index < steps.length - 1" class="arrow">↓</div>
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
      steps: [] // Store the roadmap steps here
    };
  },
  async mounted() {
    await this.sendData();
  },
  methods: {
    async sendData() {
      try {
        axios.defaults.withCredentials = true;

        const response = await axios.get('https://guiriba.com/API/Fuckyou3');
        console.log('Response:', response.data);

        // Process the response and populate steps
        this.steps = response.data.map((step) => ({
          MainTopic: step.MainTopic,
          Topic: step.Topic,
          SubTopic1: step.SubTopic1,
          SubTopic2: step.SubTopic2,
          Link: step.Link,
        }));
      } catch (error) {
        console.error('There was an error!', error);
      }
    },
    createRoadmap() {
      this.$router.push('/');
    },
  },
};
</script>

<style scoped>
@import './RoadmapPage.css';  
</style>

  