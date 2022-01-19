<template>
  <div class="app-container">
    <div class="filter-container">
      <el-col :span="24">
        <span style="font-size:14px">Course:</span>
        <el-autocomplete
          v-model="listQuery.courseName"
          :fetch-suggestions="queryCourseSearch"
          :trigger-on-focus="false"
          class="filter-item"
          style="min-width:500px"
          placeholder="Search course name"
        />
        <span style="font-size:14px"> Student:</span>
        <el-autocomplete
          v-model="listQuery.userName"
          :fetch-suggestions="queryUserSearch"
          :trigger-on-focus="false"
          class="filter-item"
          style="min-width:200px"
          placeholder="Search Student name"
        />
        <span style="font-size:14px"> Status:</span>
        <el-select v-model="listQuery.statusID" class="filter-item" placeholder="Status">
          <el-option
            v-for="item in statusOptions"
            :key="item.statusID"
            :label="item.statusName"
            :value="item.statusID">
          </el-option>
        </el-select>
        <el-button v-waves class="filter-item" type="primary" icon="el-icon-search" @click="handleFilter">
          {{ $t('table.search') }}
        </el-button>
      </el-col>
    </div>
    <el-table v-loading="loading" :data="list" border fit highlight-current-row style="width: 100%">
      <el-table-column align="center" label="Enrolment Date" width="200px">
        <template slot-scope="scope">
          <span>{{ scope.row.created_at | parseTime('{y}-{m}-{d} {h}:{i}:{s}') }}</span>
        </template>
      </el-table-column>
      <el-table-column align="left" label="Course Name" min-width="500px">
        <template slot-scope="scope">
          <router-link :to="'/courses/profile/'+scope.row.courseID" class="el-link el-link--primary is-underline">
            <span>{{ scope.row.courseName }}</span>
          </router-link>
        </template>
      </el-table-column>
      <el-table-column width="200" align="center" label="Student Name">
        <template slot-scope="scope">
          <router-link :to="'/user/profile/'+scope.row.userID" class="el-link el-link--primary is-underline">
            <span>{{ scope.row.name }}</span>
          </router-link>
        </template>
      </el-table-column>
      <el-table-column align="center" label="Status" width="150">
        <template slot-scope="scope">
          <el-tag :type="scope.row.statusID | statusFilter">
            {{ scope.row.statusName }}
          </el-tag>
        </template>
      </el-table-column>
      <el-table-column align="center" label="Actions" width="250">&nbsp;
      </el-table-column>
    </el-table>
    <pagination v-show="total>0" :total="total" :page.sync="listQuery.page" :limit.sync="listQuery.limit" @pagination="getList" />
  </div>
</template>

<script>
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
// import Resource from '@/api/resource';
import waves from '@/directive/waves';
// const itemDetailResource = new Resource('item');
import axios from 'axios';

export default {
  name: 'Enrolment',
  components: { Pagination },
  directives: { waves },
  filters: {
    statusFilter(statusID) {
      var tagclass = '';
      switch (statusID) {
        case 1:
          tagclass = 'danger';
          break;
        case 2:
          tagclass = 'info';
          break;
        case 3:
          tagclass = 'success';
          break;
      }
      return tagclass;
    },
  },
  data() {
    return {
      courselist: [],
      list: null,
      total: 0,
      loading: true,
      listQuery: {
        page: 1,
        limit: 10,
        courseName: '',
        userName: '',
      },
      statusOptions: [
        { statusID: 0, statusName: 'All' },
        { statusID: 1, statusName: 'Not Started' },
        { statusID: 2, statusName: 'In Progress' },
        { statusID: 3, statusName: 'Completed' },
      ],
      redirectUri: '/enrolment',
    };
  },
  created() {
    this.getList();
  },
  methods: {
    getList() {
      this.loading = true;
      axios({
        method: 'post',
        url: '/api/enrolment',
        data: this.listQuery,
      }).then((res) => {
        this.list = res.data.data;
        this.list.forEach((element, index) => {
          element['index'] = (this.listQuery.page - 1) * this.listQuery.limit + index + 1;
        });
        this.total = res.data.total;
        this.loading = false;
      });
    },
    queryCourseSearch(queryString, cb){
      axios({
        method: 'post',
        url: '/api/course/sugesission',
        data: this.listQuery,
      }).then((res) => {
        cb(res.data);
      });
    },
    queryUserSearch(queryString, cb){
      axios({
        method: 'post',
        url: '/api/user/sugesission',
        data: this.listQuery,
      }).then((res) => {
        cb(res.data);
      });
    },
    handleFilter() {
      this.listQuery.page = 1;
      this.getList();
    },
  },
};
</script>

<style scoped>
  .edit-input {
    padding-right: 100px;
  }
  .cancel-btn {
    position: absolute;
    right: 15px;
    top: 10px;
  }
  .pagination-container{
    margin-top:5px;
    padding: 10px 13px;
  }
</style>
