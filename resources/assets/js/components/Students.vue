<template>
  <div class="students">
    <div class="mold-buttons">
      <el-button type="success" @click="dialogVisible = true" round icon="el-icon-plus">Adicionar novo aluno</el-button>
    </div>
    <el-table :data="tableData" style="width: 100%">
      <el-table-column prop="date" label="Matrícula"></el-table-column>
      <el-table-column prop="date" label="Nome do aluno"></el-table-column>
      <el-table-column prop="date" label="Cidade"></el-table-column>
      <el-table-column prop="date" label="UF"></el-table-column>
      <el-table-column prop="date" label="E-Mail"></el-table-column>
      <el-table-column prop="date" label="Data de entrada"></el-table-column>
    </el-table>

    <el-dialog title="Cadastrar novo aluno" :visible.sync="dialogVisible" width="50%" :before-close="handleClose">
      <el-form :model="ruleForm" :rules="rules" ref="ruleForm">
        <div class="row">
          <div class="col-md-4">
            <el-form-item prop="matricula">
              <el-input v-model="ruleForm.matricula" placeholder="Matrícula"></el-input>
            </el-form-item>
          </div>
          <div class="col-md-4">
            <el-form-item prop="nome">
              <el-input v-model="ruleForm.nome" placeholder="Nome do aluno"></el-input>
            </el-form-item>
          </div>
          <div class="col-md-4">
            <el-form-item prop="data">
              <el-date-picker
              class="date-entrada"
              v-model="ruleForm.date" type="date" placeholder="Data de entrada" format="yyyy/MM/dd" value-format="yyyy-MM-dd">
            </el-date-picker>
          </el-form-item>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <el-form-item prop="endereco">
            <el-input v-model="ruleForm.endereco" placeholder="Endereço"></el-input>
          </el-form-item>
        </div>
        <div class="col-md-4">
          <el-form-item prop="bairro">
            <el-input v-model="ruleForm.bairro" placeholder="Bairro"></el-input>
          </el-form-item>
        </div>
        <div class="col-md-4">
          <el-form-item prop="cep">
            <el-input v-model="ruleForm.cep" placeholder="CEP"></el-input>
          </el-form-item>
        </div>
        <div class="col-md-4">
          <el-form-item prop="cidade">
            <places v-model="ruleForm.cidade" placeholder="Cidade" @change="val => { location.data = val.latlng, location.label = val.value}"
              :options="{countries: ['BR'], type: 'city',language: 'pt_BR'}">
            </places>
          </el-form-item>
        </div>
        <div class="col-md-4">
          <el-form-item  prop="uf">
            <el-select v-model="ruleForm.uf" placeholder="Unidade da Federação" class="select-uf">
              <el-option label="Zone one" value="shanghai"></el-option>
              <el-option label="Zone two" value="beijing"></el-option>
              <el-option label="Zone one" value="shanghai"></el-option>
              <el-option label="Zone two" value="beijing"></el-option>
              <el-option label="Zone one" value="shanghai"></el-option>
              <el-option label="Zone two" value="beijing"></el-option>
              <el-option label="Zone one" value="shanghai"></el-option>
              <el-option label="Zone two" value="beijing"></el-option>
              <el-option label="Zone one" value="shanghai"></el-option>
              <el-option label="Zone two" value="beijing"></el-option>
            </el-select>
          </el-form-item>
        </div>
        <div class="col-md-4">
          <el-form-item prop="email">
            <el-input v-model="ruleForm.email" placeholder="E-Mail"></el-input>
          </el-form-item>
        </div>



      </div>



      <el-form-item>
        <el-button type="primary" @click="submitForm('ruleForm')">Adicionar novo aluno</el-button>
        <el-button @click="resetForm('ruleForm')">Limpar</el-button>
      </el-form-item>
    </el-form>
  </el-dialog>


</div>
</template>

<script>
import Places from 'vue-places'
export default {
  components: {
    Places
  },
  data() {
    return {
      ruleForm: {
        nome: '',
        matricula: '',
        endereco: '',
        bairro: '',
        cep: '',
        cidade: '',
        uf: '',
        email: '',
        data: '',
      },
      rules: {
        nome: [
          { required: true, message: 'Escreva o nome do aluno', trigger: 'blur' },
        ],
        matricula: [
          { required: true, message: 'Digite o número da matrícula', trigger: 'blur' },
        ],
        endereco: [
          { required: true, message: 'Descreva o endereço do aluno', trigger: 'blur' },
        ],
        bairro: [
          { required: true, message: 'Escreva o bairro do aluno', trigger: 'blur' },
        ],
        cep: [
          { required: true, message: 'CEP obrigatório', trigger: 'blur' },
        ],
        cidade: [
          { required: true, message: 'Pesquise a cidade do aluno', trigger: 'blur' },
        ],
        uf: [
          { required: true, message: 'Qual o estado do aluno', trigger: 'blur' },
        ],
        email: [
          { required: true, message: 'Campo de e-mail obrigatório', trigger: 'blur' },
        ],
        data: [
          { required: true, message: 'Data de entrada obrigatório', trigger: 'blur' },
        ],
      },
      location: {
        label: null,
        data: {},
      },
      dialogVisible: false,
    }
  },
  methods: {
    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          alert('submit!');
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
<style>
.mold-buttons {
  margin-bottom: 28px;
}
.select-uf {
  width: 100%;
}
</style>
