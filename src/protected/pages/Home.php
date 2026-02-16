<?php
use Prado\Web\UI\TPage;
use Prado\Web\UI\ActiveControls\TActiveRecord; // Ensure TActiveRecord is imported if needed, usually global or via namespace

Prado::using('Application.database.ProfileRecord');
Prado::using('Application.database.UserRecord');


class Home extends TPage
{
    public function onLoad($param)
    {
        parent::onLoad($param);
        if (!$this->IsPostBack) {

        // condition pour afficher que les profiles actifs dans dropdownlist
      $this->UserProfile->DataSource = ProfileRecord :: finder()->findAll("active =TRUE");
      $this->UserProfile->DataTextField = "label";
      $this->UserProfile->DataValueField = "id";
      $this->UserProfile->DataBind();

            $this->bindGrid();
        }
    }

    protected function bindGrid($search = null)
    {
        $criteria = null;
        if ($search !== null && trim($search) !== '') {
            $criteria = new \Prado\Data\ActiveRecord\TActiveRecordCriteria;
            $criteria->Condition = 'nom LIKE :search OR email LIKE :search';
            $criteria->Parameters[':search'] = '%' . trim($search) . '%';
        }

       $data = UserRecord::finder()->findAll($criteria);
        // --- DEBUG ICI ---
  //  echo "<pre>";
    //var_dump($data); 
    //echo "</pre>";
    //die(); 
    // -----------------
        
        $this->UserGrid->DataSource =  $data ;
        $this->UserGrid->dataBind();
    }

    public function onSearch($sender, $param)
    {
        $this->bindGrid($this->SearchText->Text);
    }

    public function onResetSearch($sender, $param)
    {
        $this->SearchText->Text = '';
        $this->bindGrid();
    }

    public function onSave($sender, $param)
    {
        if ($this->IsValid) {
            $id = $this->UserId->Value;
            $user = null;

            if (!empty($id)) {
                // Update
                $user = UserRecord::finder()->findByPk($id);
            }

            if ($user === null) {
                // Create
                $user = new UserRecord;
            }

            $user->nom = $this->UserNom->Text;
            $user->email = $this->UserEmail->Text;
            $user->id_profile = $this->UserProfile->SelectedValue;

            try {
                $user->save();
                $this->resetForm();
                $this->bindGrid($this->SearchText->Text);
                $this->MessageLabel->Text = "Utilisateur enregistré avec succès.";
                $this->MessageLabel->ForeColor = "green";
            } catch (\Exception $e) {
                $this->MessageLabel->Text = "Erreur : " . $e->getMessage();
                $this->MessageLabel->ForeColor = "red";
            }
        }
    }

    public function onEdit($sender, $param)
    {
        // Get the primary key (ID) from the row that triggered the command
        $id = $this->UserGrid->DataKeys[$param->Item->ItemIndex];
        
        $user = UserRecord::finder()->findByPk($id);
        if ($user) {
            $this->UserId->Value = $user->id;
            $this->UserNom->Text = $user->nom;
            $this->UserEmail->Text = $user->email;
            $this->UserProfile->SelectedValue = $user->id_profile;
            
            $this->FormTitle->Text = "Modifier l'utilisateur ID: " . $user->id;
            $this->SaveBtn->Text = "Mettre à jour";
        }
    }

    public function onDelete($sender, $param)
    {
        $id = $this->UserGrid->DataKeys[$param->Item->ItemIndex];
        UserRecord::finder()->deleteByPk($id);
        $this->bindGrid($this->SearchText->Text);
        $this->resetForm(); // Reset form if we deleted the currently edited user
    }

    public function onCancel($sender, $param)
    {
        $this->resetForm();
    }

    protected function resetForm()
    {
        $this->UserId->Value = '';
        $this->UserNom->Text = '';
        $this->UserEmail->Text = '';
        $this->UserProfile->SelectedValue = '';
        $this->FormTitle->Text = "Ajouter un utilisateur";
        $this->SaveBtn->Text = "Enregistrer";
        $this->MessageLabel->Text = '';
    }

    public function getUserHabilitations($user)
    {
        if ($user->profile && $user->profile->habilitations) {
            $habs = [];
            foreach ($user->profile->habilitations as $hab) {
                $habs[] = $hab->label;
            }
            return implode(', ', $habs);
        }
        return '';
    }
        
}
