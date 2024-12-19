<template>
    <div class="landing-page">
      <b-container fluid>
        
          <b-row align-v="center rowPrompt">
            <!-- Image Column -->
            <b-col lg="5" md="6" sm="12" class="d-flex justify-content-center align-items-center mb-4 mb-lg-0">
              <b-img src="/src/assets/roadmap.png" alt="Roadmap" class="roadmapImg"></b-img>
            </b-col>
  
            <!-- Text Content Column -->
            <b-col lg="7" md="6" sm="12">
              <h1 class="title mb-4">
                Build Your
                Path to <span class="success">Success</span>
              </h1>
              <p class="subtitle mb-4">
                Generate a personalized roadmap of your desired software engineering / information technology topics.
              </p>
              <b-input-group>
                <b-form-input
                  v-model="query"
                  placeholder="What do you want to learn today? (e.g., Python, React, Java)"
                  @keyup.enter="search"
                />
                <b-input-group-append>
                  <b-button @click="search" variant="primary">✓</b-button>
                </b-input-group-append>
              </b-input-group>
  
              <b-button-group class="mt-3 flex-wrap">
                <b-button
                  v-for="topic in topics"
                  :key="topic"
                  @click="setQuery(topic)"
                  variant="outline-primary"
                  class="topic-button mb-2"
                >
                  {{ topic }}
                </b-button>
              </b-button-group>
            </b-col>
          </b-row>
       
  
  
        <!-- Second Row: Features Section -->
        <b-row class="rowFeatures">
          <!-- Features Title Section -->
          <b-col lg="6" md="12" sm="12" class="features-title">
            <h1 class="title mb-2">Our Features</h1>
            <p class="subtitle mb-4">How Roadmap AI Helps You</p>
          </b-col>
  
          <!-- Features Cards Section -->
          <b-col lg="6" md="12" sm="12" class="features-cards">
            <b-card v-for="(feature, index) in features" :key="index" class="feature-card">
              <b-row>
                <b-col lg="2" md="2" sm="2" cols="2">
                  <div class="feature-icon d-flex justify-content-center">✓</div>
                </b-col>
  
                <b-col lg="10" md="10" sm="10" cols="10">
                  <div class="feature-content">
                    <h3>{{ feature.title }}</h3>
                    <p>{{ feature.description }}</p>
                  </div>
                </b-col>
  
              </b-row>
  
  
            </b-card>
          </b-col>
        </b-row>
  
  
        <!-- Third Row: How It Works Section -->
        <b-row class="rowProcess">
          <b-col lg="12" class="text-center process-title">
            <h1 class="process-title mb-2">See how it works</h1>
            <p class="process-subtitle mb-4">Explore the steps and process</p>
          </b-col>
  
          <b-row class="rowSteps">
            <b-col lg="3" md="6" sm="6" cols="6" v-for="(step, index) in steps" :key="index" class="step-cards">
              
                <div class="number-icon">{{ step.icon }}</div>
                <h3 class="step-title">{{ step.title }}</h3>
                <p class="step-description">
                  {{ step.description }}
                </p>
              
            </b-col>
          </b-row>
        </b-row>
  
        <!-- Fourth Row: Testimonials Carousel -->
        <b-row class="rowTestimonials">
          <b-col lg="4" md="12" sm="12" class="testimonials">
            <h1 class="testimonial-title mb-2">Testimonials</h1>
            <p class="testimonial-subtitle mb-4">Why people love Roadmap AI</p>
            <b-button @click="handlePrev" variant="link" class="carousel-control prev">
              <b-img src="/src/assets/leftbtn.png" alt="Previous"></b-img>
            </b-button>
            <b-button @click="handleNext" variant="link" class="carousel-control next">
              <b-img src="/src/assets/rightbtn.png" alt="Next"></b-img>
            </b-button>
          </b-col>
  
          <b-col lg="8" md="12" sm="12" class="testimonials-carousel">
            <div class="carousel-track">
              <b-card v-for="(testimonial, index) in testimonials" :key="index" :style="getTransformStyles(index)"
                class="testimonial-card">
                <b-row class="card-elements">
                  <b-img :src="testimonial.icon" alt="User Icon" fluid class="testimonial-icon col-lg-4"></b-img>
  
                  <div class="testimonial-name col-lg-8">
                    <h5>{{ testimonial.name }}</h5>
                    <p class="testimonial-course">{{ testimonial.course }}</p>
                  </div>
                  <p class="testimonial-desc">{{ testimonial.description }}</p>
                </b-row>
              </b-card>
            </div>
          </b-col>
        </b-row>
  
        <!-- Fifth Row: FAQs -->
        <b-row class="rowFAQs">
          <b-col lg="6" class="faqs">
            <h1 class="title mb-2">Frequently Asked Questions</h1>
            <p class="subtitle mb-4">Ready to create your own learning roadmap?</p>
          </b-col>
  
          <b-col lg="6" class="accordion-faqs">
            <b-accordion flush>
              <b-accordion-item id="faq1" title="What topics and languages are available on RoadmapAI?">
                RoadmapAI covers a variety of programming languages, frameworks, and software engineering topics,
                including but
                not limited to JavaScript, Python, Java, HTML/CSS, React, Vue, and databases like MySQL.
              </b-accordion-item>
              <b-accordion-item id="faq2" title="How does RoadmapAI track my learning progress?">
                RoadmapAI tracks progress by allowing users to mark topics and subtopics as completed.
              </b-accordion-item>
              <b-accordion-item id="faq3" title="What learning resources are available on RoadmapAI?">
                For each topic, RoadmapAI provides detailed descriptions, definitions, and links to external resources.
              </b-accordion-item>
            </b-accordion>
          </b-col>
        </b-row>
      </b-container>
    </div>
  </template>
  
  <script>
  
  export default {
    name: "LandingPage",
    data() {
      return {
        query: "",
        activeIndex: 0,
        isTransitioning: false,
        topics: [
          "Frontend Development",
          "Backend Development",
          "Full Stack Development",
          "React",
          "Python",
          "JavaScript",
          "TypeScript",
          "Java",
          "HTML",
          "CSS",
        ],
        features: [
          {
            title: "Personalized Roadmaps:",
            description: "Customize your journey to your technology stack of choice.",
          },
          {
            title: "Progress Tracker:",
            description: "Visualize your learning progress and milestones.",
          },
          {
            title: "Learning Materials:",
            description: "Access descriptions, samples, and definitions for each subtopic.",
          },
          {
            title: "External Resources:",
            description: "Direct links to tutorials and documentation.",
          },
        ],
        steps: [
          {
            icon: "1",
            title: "Choose a topic.",
            description:
              "Select a language or topic that aligns with your career goals or personal interests.",
          },
          {
            icon: "2",
            title: "Get a roadmap.",
            description:
              "RoadmapAI generates a tailored roadmap organized into main topics and essential subtopics.",
          },
          {
            icon: "3",
            title: "Track Your Progress.",
            description:
              "Mark each completed topic to see your advancement on the roadmap, showing your learning progress.",
          },
          {
            icon: "4",
            title: "Explore Resources",
            description:
              "Every topic consists of links to external resources—tutorials, articles, and documentation.",
          },
        ],
        testimonials: [
          {
            icon: "/src/assets/vue.svg",
            name: "Alice Johnson",
            course: "Frontend Development",
            description:
              "Roadmap AI helped me create a structured learning plan that made mastering React much easier.",
          },
          {
            icon: "/src/assets/vue.svg",
            name: "Michael Lee",
            course: "Data Science",
            description:
              "The personalized roadmap feature guided me through complex data analysis topics efficiently.",
          },
          {
            icon: "/src/assets/vue.svg",
            name: "Emily Davis",
            course: "Full Stack Development",
            description:
              "I loved how the app tracked my progress and suggested additional resources for each topic.",
          },
          {
            icon: "/src/assets/vue.svg",
            name: "John Smith",
            course: "Backend Development",
            description:
              "The roadmap generated by this app gave me a clear path to becoming a proficient backend developer.",
          },
        ],
      };
    },
    methods: {
      search() {
        if (this.query) {
          alert(`Searching for: ${this.query}`);
        }
      },
      setQuery(topic) {
        this.query = topic;
      },
      handleNext() {
        console.log("Next button clicked"); // Debugging line
        if (this.isTransitioning) return;
        this.isTransitioning = true;
  
        // Calculate the next index
        this.activeIndex = (this.activeIndex + 1) % this.testimonials.length;
  
        setTimeout(() => {
          this.isTransitioning = false;
        }, 400);
      },
  
  
      handlePrev() {
        if (this.isTransitioning) return;
        this.isTransitioning = true;
        this.activeIndex =
          this.activeIndex === 0
            ? this.testimonials.length - 1
            : this.activeIndex - 1;
  
        setTimeout(() => {
          this.isTransitioning = false;
        }, 400);
      },
      getTransformStyles(index) {
        const totalItems = this.testimonials.length;
        const previousIndex = (this.activeIndex - 1 + totalItems) % totalItems;
        const nextIndex = (this.activeIndex + 1) % totalItems;
  
        if (index === this.activeIndex) {
          return {
            transform: "translateX(0) scale(1)",
            opacity: 1,
            zIndex: 3,
          };
        } else if (index === previousIndex) {
          return {
            transform: "translateX(-107%) scale(1)",
            opacity: 1,
            zIndex: 2,
            visibility: "hidden",
          };
        } else if (index === nextIndex) {
          return {
            transform: "translateX(107%) scale(1)",
            opacity: 1,
            zIndex: 2,
            filter: "blur(2px)",
          };
        } else {
          return {
            transform: "translateX(207%) scale(1)",
            opacity: 0,
            zIndex: 1,
            visibility: "hidden",
          };
        }
      },
    },
  };
  
  </script>
  
  <style scoped>
  @import './LandingPage.css';
  </style>