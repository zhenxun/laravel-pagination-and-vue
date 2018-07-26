<template>
    <div class="d-flex flex-column justify-content-center">
        <div class="p-2 bd-highlight" v-for="(article, index) in articles">
            <div class="card">
              <div class="card-header">
                {{ article.id }}  {{ article.title }}
              </div>
              <div class="card-body">
                {{ article.content }}
              </div>
            </div>
        </div>
        
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link" 
                 href="#" 
                 v-on:click="fetchPaginateArticles(pagination.prev_page_url)" 
                 :disabled="!pagination.prev_page_url">
                 Previous
                 </a>
            </li>
            <li class="page-item" v-for="n in 10">
              <a class="page-link" href="#">{{ n }}</a>
            </li>
            <li class="page-item">
              <a class="page-link" 
                 href="#" 
                 v-on:click="fetchPaginateArticles(pagination.next_page_url)" 
                 :disabled="!pagination.next_page_url">
                 Next
                 </a>
            </li>
          </ul>

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
            pagination: [],
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
                  console.log(response.data);
                 this.articles = response.data.data

                 $this.makePagination(response.data)
                 this.pageSet.totalRow = response.data.total;
              })
          },
          makePagination(data) {
            let pagination = {
              current_page: data.current_page,
              last_page: data.last_page,
              next_page_url: data.next_page_url,
              prev_page_url: data.prev_page_url,
              total: data.total
            }

            this.pagination = pagination
          },
          fetchPaginateArticles(url) {
            this.url = url
            this.getArticles()
          },
          pageChange(pInfo) {
            let that = this;
            console.log(pInfo);
            console.log(pInfo.pageNumber);
              var purl = this.pageUrl + pInfo.pageNumber;
              axios.get(purl).then(response => {
                  console.log(response.data);
                 this.articles = response.data.data
              })            
          }
        },

        mounted() {
            this.getArticles();
            console.log('Articles Component mounted.')
        }
    }
</script>
