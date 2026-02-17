<?php
use Prado\Web\UI\TPage;
use Prado\Web\UI\ActiveControls\TActiveRecord; 

Prado::using('Application.database.ProfileRecord'); 
Prado::using('Application.database.HabilitationRecord'); 
Prado::using('Application.database.ProfileHabilitationRecord');
Prado::using('Application.database.UserRecord');

class Profiles extends TPage
{
    public function onLoad($param)
    {
        parent::onLoad($param);
        if (!$this->IsPostBack) {

             $habilitations = HabilitationRecord::finder()->findAll('active = 1');

        $this->ProfileHabilitations->DataSource = $habilitations;
        $this->ProfileHabilitations->DataTextField = 'label';
        $this->ProfileHabilitations->DataValueField = 'id';
        $this->ProfileHabilitations->dataBind();

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

       $data = ProfileRecord::finder()->findAll($criteria);
    
        
        $this->ProfileGrid->DataSource =  $data ;
        $this->ProfileGrid->dataBind();
       
   
    }

   

  public function onSave($sender, $param)
{
    if ($this->IsValid) {
        $id = $this->ProfileId->Value;
        
        try {
            if (!empty($id)) {
                $profile = ProfileRecord::finder()->findByPk($id);
            } else {
                $profile = new ProfileRecord;
            }

            $profile->label = $this->ProfileLabel->Text;
            $profile->active = $this->ProfileActive->Checked ? 1 : 0;

              // 1. Sauvegarder l'objet principal (pour avoir l'ID)
                                   $profile->save();

            //if(!$profile->active){
            //foreach($profile->users as $user){
           // $user->active = FALSE;
            //}
           // } s'amarche pas

           $isActive = $profile->active;



           if($isActive == FALSE){
          $usersToDesactive = UserRecord::finder()->findAll('id_profile = ?',$profile->id);

          foreach($usersToDesactive as $user){
             $user->active = FALSE;
             $user->save();
          }

      $deactivatedCount =  count($usersToDesactive);

           }







            // 2. Récupérer les IDs sélectionnés depuis le TCheckBoxList
            $selectedIds = $this->ProfileHabilitations->SelectedValues;
            //var_dump($selectedIds); 
            //die();
            
//             // 3. Vider et remplir la relation proprement
//             // On récupère les objets records correspondant aux sélections
//             $habilitations = [];
//             if (!empty($selectedIds)) {
//                 foreach ($selectedIds as $habId) {
//                     $hab = HabilitationRecord::finder()->findByPk($habId);
//                     if ($hab) {
//                         $habilitations[] = $hab;
//                     }
//                 }
//             }
// //    var_dump($habilitations);  die(); 

//             // 4. Utilisation de saveRelation pour forcer l'écriture dans 'profile_habilitation'
//             $profile->habilitations = $habilitations;
//            // var_dump($profile->habilitations); 
//               //  die()
      
 // alors l'assignation ete incorecte donc j'ai creer la class ProfileHabilitationRecord pour gerer la table de jointure
                
//             $profile->saveRelation('habilitations'); 





 // 3. Supprimer toutes les anciennes associations
                ProfileHabilitationRecord::finder()->deleteAll('id_profile = ?', $profile->id);
                
                // 4. Créer les nouvelles associations
                if (!empty($selectedIds)) {
                    foreach ($selectedIds as $habId) {
                        $link = new ProfileHabilitationRecord();
                        $link->id_profile = $profile->id;
                        $link->id_habilitation = $habId;
                        $link->save();
                    }
                }

            $this->resetForm();
            $this->bindGrid($this->SearchText->Text);

              $message = "Profil enregistré avec succès.";

            if(isset($deactivatedCount) && $deactivatedCount > 0 ){

            $message .= "($deactivatedCount} utilisateur(s) désactivé(s))";

            }
            $this->MessageLabel->Text =   $message;
            $this->MessageLabel->ForeColor = "green";

        } catch (\Exception $e) {
            $this->MessageLabel->Text = "Erreur : " . $e->getMessage();
            $this->MessageLabel->ForeColor = "red";
        }
    }
}
    public function onEdit($sender, $param)
    {
       
        $id = $this->ProfileGrid->DataKeys[$param->Item->ItemIndex];
        
        $profile = ProfileRecord::finder()->findByPk($id);
        if ($profile) {
            $this->ProfileId->Value = $profile->id;
            $this->ProfileLabel->Text = $profile->label;
            $this->ProfileActive->Checked = $profile->active == 1;
            
        $selected = [];

        foreach ($profile->habilitations as $hab) {
            $selected[] = $hab->id;
        }

        $this->ProfileHabilitations->SelectedValues = $selected;

            $this->FormTitle->Text = "Modifier le profil ID: " . $profile->id;
            $this->SaveBtn->Text = "Mettre à jour";
        }
    }

    public function onDelete($sender, $param)
    {
        // on va supprimer le profil juste si il n'est associé à aucun utilisateur ou aucune habilitation
         $id = $this->ProfileGrid->DataKeys[$param->Item->ItemIndex];
         $profile = ProfileRecord::finder()->findByPk($id);
         if ($profile) {
             if (count($profile->users) > 0 || count($profile->habilitations) > 0) {
                 $this->MessageLabel->Text = "Impossible de supprimer ce profil car il est associé à des utilisateurs ou des habilitations.";
                 $this->MessageLabel->ForeColor = "red";
             } else {
                 $profile->delete();
                 $this->bindGrid($this->SearchText->Text);
                 $this->resetForm(); // Reset form if we deleted the currently edited profile
                 $this->MessageLabel->Text = "Profil supprimé avec succès.";
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
        $this->ProfileId->Value = '';
        $this->ProfileLabel->Text = '';
        $this->ProfileActive->Checked = false;
        $this->ProfileHabilitations->SelectedValues = [];
        $this->FormTitle->Text = "Ajouter un profil";
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


