<?php
use Prado\Web\UI\TPage;
use Prado\Web\UI\ActiveControls\TActiveRecord; 

Prado::using('Application.database.HabilitationRecord'); 

class Habilitations extends TPage
{
    public function onLoad($param)
    {
        parent::onLoad($param);
        if (!$this->IsPostBack) {

            $this->bindGrid();
        }
    }

    protected function bindGrid($search = null)
    {

         $criteria = null;
        if ($search !== null && trim($search) !== '') {
            $criteria = new \Prado\Data\ActiveRecord\TActiveRecordCriteria;
            $criteria->Condition = 'label LIKE :search';
            $criteria->Parameters[':search'] = '%' . trim($search) . '%';
        }

       $data = HabilitationRecord::finder()->findAll($criteria);
    
        
        $this->HabilitationGrid->DataSource =  $data ;
        $this->HabilitationGrid->dataBind();
    }

   

    public function onSave($sender, $param)
    {
        if ($this->IsValid) {
            $id = $this->HabilitationId->Value;
            $habilitation = null;

            if (!empty($id)) {
                // Update
                $habilitation= HabilitationRecord::finder()->findByPk($id);
            }

            if ($habilitation === null) {
                // Create
                $habilitation = new HabilitationRecord;
            }

            $habilitation->label = $this->HabilitationLabel->Text;
            $habilitation->active = $this->HabilitationActive->Checked ? 1 : 0;

            try {
                $habilitation->save();
                $this->resetForm();
                $this->bindGrid($this->SearchText->Text);
                $this->MessageLabel->Text = "Habilitation enregistré avec succès.";
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
        $id = $this->HabilitationGrid->DataKeys[$param->Item->ItemIndex];
        
        $habilitation = HabilitationRecord::finder()->findByPk($id);
        if ($habilitation) {
            $this->HabilitationId->Value = $habilitation->id;
            $this->HabilitationLabel->Text = $habilitation->label;
            $this->HabilitationActive->Checked = $habilitation->active == 1;
            
            $this->FormTitle->Text = "Modifier le habilitation ID: " . $habilitation->id;
            $this->SaveBtn->Text = "Mettre à jour";
        }
    }

    public function onDelete($sender, $param)
    {
        // on va supprimer l'habilitation juste si il n'est associé à aucun profile
         $id = $this->HabilitationGrid->DataKeys[$param->Item->ItemIndex];
         $habilitation = HabilitationRecord::finder()->findByPk($id);
         if ($habilitation) {
             if (count($habilitation->profiles) > 0) {
                 $this->MessageLabel->Text = "Impossible de supprimer cette habilitation car il est associé à des profils.";
                 $this->MessageLabel->ForeColor = "red";
             } else {
                 $habilitation->delete();
                 $this->bindGrid($this->SearchText->Text);
                 $this->resetForm(); // Reset form if we deleted the currently edited profile
                 $this->MessageLabel->Text = "Habilitation supprimé avec succès.";
                 $this->MessageLabel->ForeColor = "green";
             }
         }
    }

    public function onCancel($sender, $param)
    {
        $this->resetForm();
    }

    protected function resetForm()
    {
        $this->HabilitationId->Value = '';
        $this->HabilitationLabel->Text = '';
        $this->HabilitationActive->Checked = false;
        $this->FormTitle->Text = "Ajouter une habilitation";
        $this->SaveBtn->Text = "Enregistrer";
        $this->MessageLabel->Text = '';
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
}
