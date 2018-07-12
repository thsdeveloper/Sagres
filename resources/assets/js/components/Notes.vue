<template>
  <div class="students" v-loading.fullscreen.lock="loading" element-loading-text="Cadastrando nota...">
    <div class="mold-buttons">
      <div class="row">
        <div class="col-md-6">
          <h2>Aplicar notas</h2>
        </div>
        <div class="col-md-6">
          <el-button type="success" @click="dialogVisible = true" round icon="el-icon-plus" class="btn-mold-default">Adicionar nova nota</el-button>
        </div>
      </div>
    </div>
    <el-table :data="notes" style="width: 100%" border>
      <el-table-column prop="student_id" label="Aluno"></el-table-column>
      <el-table-column prop="discipline_id" label="Disciplina"></el-table-column>
      <el-table-column prop="note" label="Nota aplicada">
        <template slot-scope="scope">
          <el-rate
            v-model="scope.row.note"
            :max="10"
            disabled
            show-score
            text-color="#ff9900"
            score-template="Nota: {value}">
          </el-rate>
        </template>


      </el-table-column>
    </el-table>

    <el-dialog title="Inserir nota por aluno" :visible.sync="dialogVisible" width="30%">
      <el-form :model="ruleForm" :rules="rules" ref="ruleForm">
        <div class="row">
          <div class="col-md-12">
            <el-form-item prop="student_id">
              <el-select v-model="ruleForm.student_id" placeholder="Selecione o aluno" class="select-uf">
                <el-option
                v-for="s in students"
                :key="s.id"
                :label="s.nome"
                :value="s.id">
              </el-option>
            </el-select>
          </el-form-item>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <el-form-item prop="discipline_id">
            <el-select v-model="ruleForm.discipline_id" placeholder="Escolha a disciplina" class="select-uf">
              <el-option
              v-for="d in disciplines"
              :key="d.id"
              :label="d.nome"
              :value="d.id">
            </el-option>
          </el-select>
        </el-form-item>
      </div>
      <div class="col-md-12">
        <span class="center-text">Selecione uma nota de 0 à 10 para o aluno</span>
        <el-form-item prop="nota">
          <el-slider
          class="slider-notas"
          :min="0"
          :max="10"
          v-model="ruleForm.note"
          :step="1"
          show-stops>
        </el-slider>
      </el-form-item>
    </div>
  </div>
  <el-form-item class="mold-butons-notes">
    <el-button type="primary" round @click="submitForm('ruleForm')">Adicionar nota</el-button>
  </el-form-item>
</el-form>
</el-dialog>


</div>
</template>

<script>
export default {
  props:['notes', 'students', 'disciplines'],
  data() {
    return {
      loading: false,

      ruleForm: {
        student_id: '',
        discipline_id: '',
        note: null,
      },
      rules: {
        student_id: [
          { required: true, message: 'Escolha um aluno', trigger: ['blur', 'change']},
        ],
        discipline_id: [
          { required: true, message: 'Escolha uma disciplina', trigger: ['blur', 'change']},
        ]
      },
      dialogVisible: false,
    }
  },
  methods: {
    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          this.loading = true;
          axios.post('/insert/note', {
            student_id: this.ruleForm.student_id,
            discipline_id: this.ruleForm.discipline_id,
            note: this.ruleForm.note,
          }).then((r) => {
            this.notes.push({id: r.data.id, note: r.data.note});
            this.dialogVisible = false;
            this.loading = false;
            this.$message({
              type: 'success',
              message: 'Nota cadastrada com sucesso!'
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
