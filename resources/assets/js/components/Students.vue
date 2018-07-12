<template>
  <div class="students" v-loading.fullscreen.lock="loading" element-loading-text="Cadastrando novo aluno...">
    <div class="mold-buttons">
      <div class="row">
        <div class="col-md-6">
          <h2>Alunos</h2>
        </div>
        <div class="col-md-6">
          <el-button type="success" @click="dialogVisible = true" round icon="el-icon-plus" class="btn-mold-default">Adicionar novo aluno</el-button>
        </div>
      </div>
    </div>
    <el-table :data="students" style="width: 100%" border>

      <el-table-column prop="matricula" label="Matrícula" width="90"></el-table-column>
      <el-table-column prop="nome" label="Nome do aluno"></el-table-column>
      <el-table-column prop="email" label="E-Mail"></el-table-column>
      <el-table-column prop="cidade" label="Cidade"></el-table-column>
      <el-table-column type="expand" label="Ver notas" width="100">
        <template slot-scope="props">
          <el-table :data="props.row.note" border>
            <el-table-column prop="discipline.nome" label="Disciplina"></el-table-column>
            <el-table-column prop="note" label="Nota"></el-table-column>
          </el-table>
        </template>
      </el-table-column>
    </el-table>

    <el-dialog title="Cadastrar novo aluno" :visible.sync="dialogVisible" width="70%">
      <el-form :model="ruleForm" :rules="rules" ref="ruleForm">
        <div class="row">
          <div class="col-md-4">
            <el-form-item prop="matricula">
              <el-input v-model="ruleForm.matricula" placeholder="Número da Matrícula" v-mask="'####'"></el-input>
            </el-form-item>
          </div>
          <div class="col-md-4">
            <el-form-item prop="nome">
              <el-input v-model="ruleForm.nome" placeholder="Nome do aluno"></el-input>
            </el-form-item>
          </div>
          <div class="col-md-4">
            <el-form-item prop="data">
              <el-date-picker class="date-entrada" v-model="ruleForm.data" type="date" placeholder="Data de entrada" format="yyyy/MM/dd" value-format="yyyy-MM-dd">
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
              <el-input v-model="ruleForm.cep" placeholder="CEP"  v-mask="'##.###-###'"></el-input>
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
                <el-option label="AC" value="ac"></el-option>
                <el-option label="AL" value="al"></el-option>
                <el-option label="AM" value="am"></el-option>
                <el-option label="AP" value="ap"></el-option>
                <el-option label="BA" value="ba"></el-option>
                <el-option label="CE" value="ce"></el-option>
                <el-option label="DF" value="df"></el-option>
                <el-option label="ES" value="es"></el-option>
                <el-option label="GO" value="go"></el-option>
                <el-option label="MA" value="ma"></el-option>
                <el-option label="MG" value="mg"></el-option>
                <el-option label="MS" value="ms"></el-option>
                <el-option label="MT" value="mt"></el-option>
                <el-option label="PA" value="pa"></el-option>
                <el-option label="PB" value="pb"></el-option>
                <el-option label="PE" value="pe"></el-option>
                <el-option label="PI" value="pi"></el-option>
                <el-option label="PR" value="pr"></el-option>
                <el-option label="RJ" value="rj"></el-option>
                <el-option label="RN" value="rn"></el-option>
                <el-option label="RO" value="ro"></el-option>
                <el-option label="RR" value="rr"></el-option>
                <el-option label="RS" value="rs"></el-option>
                <el-option label="SC" value="sc"></el-option>
                <el-option label="SE" value="se"></el-option>
                <el-option label="SP" value="sp"></el-option>
                <el-option label="TO" value="to"></el-option>
              </el-select>
            </el-form-item>
          </div>
          <div class="col-md-4">
            <el-form-item prop="email">
              <el-input v-model="ruleForm.email" placeholder="E-Mail"></el-input>
            </el-form-item>
          </div>
        </div>

        <el-form-item class="mold-butons-add-students">
          <el-button type="primary" @click="submitForm('ruleForm')">Adicionar novo aluno</el-button>
          <el-button @click="resetForm('ruleForm')">Limpar</el-button>
        </el-form-item>
      </el-form>
    </el-dialog>

    <el-dialog title="Notas do Aluno: " :visible.sync="dialogNotas" width="30%">

    </el-dialog>


  </div>
</template>

<script>
import Places from 'vue-places'
export default {
  props:['students'],
  components: {
    Places
  },
  data() {
    return {
      loading: false,

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
          { type: 'email', message: 'Por favor insira o endereço de e-mail correto', trigger: ['blur', 'change'] }
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
      dialogNotas: false,
    }
  },
  methods: {
    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          this.loading = true;
          axios.post('/public/insert/studant', {
            nome: this.ruleForm.nome,
            matricula: this.ruleForm.matricula,
            endereco: this.ruleForm.endereco,
            bairro: this.ruleForm.bairro,
            cep: this.ruleForm.cep,
            cidade: this.ruleForm.cidade,
            uf: this.ruleForm.uf,
            email: this.ruleForm.email,
            data: this.ruleForm.data,
          }).then((r) => {
            this.students.push({id: r.data.id, nome: r.data.nome, matricula: r.data.matricula, endereco: r.data.endereco, bairro: r.data.bairro, cep: r.data.cep, cidade: r.data.cidade, uf: r.data.uf, email: r.data.email, data_entrada: r.data.data_entrada});
            this.dialogVisible = false;
            this.loading = false;
            this.$message({
              type: 'success',
              message: 'Aluno cadastrado com sucesso!'
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
    },
    verNota(index, row){
      this.dialogNotas = true;
    }
  },
  created(){

  },
  mounted() {

  }
}
</script>
