<template>
    <div class="d-flex flex-column justify-content-center">
        <input type="text" v-model="search" placeholder="search articles">
        <div class="p-2 bd-highlight" v-for="(article, index) in filteredArticles">
            <div class="card">
              <div class="card-header">
                {{ article.id }}  {{ article.title }}
              </div>
              <div class="card-body">
                {{ article.content }}
              </div>
            </div>
        </div>
        <v-page :setting="pageSet" @page-change="pageChange"></v-page>
    </div>
</template>


<script>
    export default {
        data(){
          return {
            articles: [],
            url: '/api/articles',
            pageUrl: '/api/articles?page=',
            search: '',
            pageSet:{
              totalRow: 0,
              language: 'zh',
              pageSizeMenu: [5]
            }
          }
        },

        methods:{
          getArticles() {
              let $this = this
              axios.get(this.url).then(response => {
                 this.articles = response.data.data
                 this.pageSet.totalRow = response.data.total;
              })
          },
          pageChange(pInfo) {
            let that = this;
              var purl = this.pageUrl + pInfo.pageNumber;
              axios.get(purl).then(response => {
                 this.articles = response.data.data
              })            
          }
        },

        created(){
           this.getArticles();
        },

        computed:{
          filteredArticles: function(){
            var self = this;
            return this.articles.filter( function (article){
              return article.title.match(self.search) || article.content.match(self.search);
            });
          }
        },

        mounted() {
            console.log('Articles Component mounted.')
        }
    }
</script>
