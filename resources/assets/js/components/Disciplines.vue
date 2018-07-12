<template>
  <div class="students" v-loading.fullscreen.lock="loading" element-loading-text="Cadastrando nova disciplina...">
    <div class="mold-buttons">
      <div class="row">
        <div class="col-md-6">
          <h2>Disciplinas</h2>
        </div>
        <div class="col-md-6">
          <el-button type="success" @click="dialogVisible = true" round icon="el-icon-plus" class="btn-mold-default">Adicionar nova disciplina</el-button>
        </div>
      </div>
    </div>
    <el-table :data="disciplines" style="width: 100%" border>
      <el-table-column prop="nome" label="Disciplina"></el-table-column>
    </el-table>

    <el-dialog title="Cadastrar nova disciplina" :visible.sync="dialogVisible" width="30%">
      <el-form :model="ruleForm" :rules="rules" ref="ruleForm">
        <div class="row">
          <div class="col-md-12">
            <el-form-item prop="nome">
              <el-input v-model="ruleForm.nome" placeholder="Nome da Disciplina"></el-input>
            </el-form-item>
          </div>
        </div>
        <el-form-item class="mold-butons-add-students">
          <el-button type="primary" @click="submitForm('ruleForm')">Adicionar nova disciplina</el-button>
          <el-button @click="resetForm('ruleForm')">Limpar</el-button>
        </el-form-item>
      </el-form>
    </el-dialog>


  </div>
</template>

<script>
export default {
  props:['disciplines'],
  data() {
    return {
      loading: false,

      ruleForm: {
        nome: '',
      },
      rules: {
        nome: [
          { required: true, message: 'Escreva o nome da disciplina', trigger: 'blur' },
        ],
      },
      dialogVisible: false,
    }
  },
  methods: {
    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          this.loading = true;
          axios.post('/insert/disciplina', {
            nome: this.ruleForm.nome,
          }).then((r) => {
            this.disciplines.push({id: r.data.id, nome: r.data.nome});
            this.dialogVisible = false;
            this.loading = false;
            this.$message({
              type: 'success',
              message: 'Disciplina cadastrada com sucesso!'
            });
          }).catch((error) => {
            this.loading = false;
            this.$notify.error({
              title: 'Error',
              message: error
            });
          });


        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    resetForm(formName) {
      this.$refs[formName].resetFields();
    }
  },
  created(){

  },
  mounted() {

  }
}
</script>
