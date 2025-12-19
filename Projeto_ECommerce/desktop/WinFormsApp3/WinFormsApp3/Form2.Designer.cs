namespace WinFormsApp3
{
    partial class Form2
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            txbUsuario = new TextBox();
            txbSenha = new TextBox();
            txbConfirmar = new TextBox();
            lblUsuario = new Label();
            lblSenha = new Label();
            lblConfirmar = new Label();
            btnCadastrar = new Button();
            chbExibir = new CheckBox();
            SuspendLayout();
            // 
            // txbUsuario
            // 
            txbUsuario.Location = new Point(116, 56);
            txbUsuario.Name = "txbUsuario";
            txbUsuario.Size = new Size(125, 27);
            txbUsuario.TabIndex = 0;
            // 
            // txbSenha
            // 
            txbSenha.Location = new Point(116, 117);
            txbSenha.Name = "txbSenha";
            txbSenha.Size = new Size(125, 27);
            txbSenha.TabIndex = 1;
            txbSenha.UseSystemPasswordChar = true;
            // 
            // txbConfirmar
            // 
            txbConfirmar.Location = new Point(116, 179);
            txbConfirmar.Name = "txbConfirmar";
            txbConfirmar.Size = new Size(125, 27);
            txbConfirmar.TabIndex = 2;
            txbConfirmar.UseSystemPasswordChar = true;
            // 
            // lblUsuario
            // 
            lblUsuario.AutoSize = true;
            lblUsuario.Location = new Point(116, 33);
            lblUsuario.Name = "lblUsuario";
            lblUsuario.Size = new Size(59, 20);
            lblUsuario.TabIndex = 3;
            lblUsuario.Text = "Usuario";
            // 
            // lblSenha
            // 
            lblSenha.AutoSize = true;
            lblSenha.Location = new Point(116, 94);
            lblSenha.Name = "lblSenha";
            lblSenha.Size = new Size(49, 20);
            lblSenha.TabIndex = 4;
            lblSenha.Text = "Senha";
            // 
            // lblConfirmar
            // 
            lblConfirmar.AutoSize = true;
            lblConfirmar.Location = new Point(116, 156);
            lblConfirmar.Name = "lblConfirmar";
            lblConfirmar.Size = new Size(119, 20);
            lblConfirmar.TabIndex = 5;
            lblConfirmar.Text = "Confirmar Senha";
            // 
            // btnCadastrar
            // 
            btnCadastrar.Location = new Point(170, 240);
            btnCadastrar.Name = "btnCadastrar";
            btnCadastrar.Size = new Size(94, 29);
            btnCadastrar.TabIndex = 6;
            btnCadastrar.Text = "Cadastrar";
            btnCadastrar.UseVisualStyleBackColor = true;
            btnCadastrar.Click += btnCadastrar_Click;
            // 
            // chbExibir
            // 
            chbExibir.AutoSize = true;
            chbExibir.Location = new Point(42, 221);
            chbExibir.Name = "chbExibir";
            chbExibir.Size = new Size(112, 24);
            chbExibir.TabIndex = 7;
            chbExibir.Text = "Exibir Senha";
            chbExibir.UseVisualStyleBackColor = true;
            chbExibir.CheckedChanged += chbExibir_CheckedChanged;
            // 
            // Form2
            // 
            AutoScaleDimensions = new SizeF(8F, 20F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(485, 333);
            Controls.Add(chbExibir);
            Controls.Add(btnCadastrar);
            Controls.Add(lblConfirmar);
            Controls.Add(lblSenha);
            Controls.Add(lblUsuario);
            Controls.Add(txbConfirmar);
            Controls.Add(txbSenha);
            Controls.Add(txbUsuario);
            Name = "Form2";
            Text = "Form2";
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private TextBox txbUsuario;
        private TextBox txbSenha;
        private TextBox txbConfirmar;
        private Label lblUsuario;
        private Label lblSenha;
        private Label lblConfirmar;
        private Button btnCadastrar;
        private CheckBox chbExibir;
    }
}