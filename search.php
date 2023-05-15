<?php
public function search()
    {

        if ($search = \Request::get('q'))
        {

            if (\Gate::allows('isSuperadministratorOrAdministrator'))

            {
                $users = User:: with('Universite')

                    ->where('type', '!=', 'Superadministrator')
                    ->orderBy('universite_id', 'ASC')
                    ->orderBy('type', 'ASC')

                    ->where(
                        function($query) use ($search)
                        {
                            $query->where('name','LIKE',"%$search%")
                                ->orWhere('prenom','LIKE',"%$search%")
                                ->orWhere('email','LIKE',"%$search%")
                                ->orWhere('cin','LIKE',"%$search%");
                        }

                    )


                    ->paginate(20);




            }


            else

            {
                if( \Gate::allows('isEnseignant')){
                    $etab = auth()->user()->etablissement_id;
                    $users = User:: with('Universite')

                        ->where('type', '!=', 'Superadministrator')
                        ->where('type', '!=', 'Administrator')
                        ->where('etablissement_id',$etab)

                        ->orderBy('universite_id', 'ASC')
                        ->orderBy('type', 'ASC')
                        ->where(
                            function($query) use ($search)
                            {
                                $query->where('name','LIKE',"%$search%")
                                    ->orWhere('prenom','LIKE',"%$search%")
                                    ->orWhere('email','LIKE',"%$search%")
                                    ->orWhere('cin','LIKE',"%$search%");

                            }

                        )
                        ->paginate(20);
                }
            }


        }

        else{

           $users = $this->index();
 //            $users = User:: with('Universite')
//               ->paginate(5);
             }

     return $users;

    }
?>