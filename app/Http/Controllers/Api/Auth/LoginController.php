<?php

//namespace App\Http\Controllers\Api\Auth;
namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ResponseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

class LoginController extends ResponseController
{
    use TokenTrait;

    /**
     * @OA\Get(
     *      path="/login",
     *      operationId="getProjectsList",
     *      tags={"Projects"},
     *      summary="Get list of projects",
     *      description="Returns list of projects",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */

    public function authenticate(Request $request)
    {


        $this->validate($request, [
            // 'email' => 'required_without:phone',

            // 'phone' => 'required_without:email',
            'login' => 'required',
            'password' => 'required',
        ]);


        //recupération des infos utilisateurs à partir du numéro de téléphone
        if (
            Auth::attempt(['email' => $request->login, 'password' => $request->password])
            or
            Auth::attempt(['phones->>*' => $request->login, 'password' => $request->password])
            //or
           // Auth::attempt(['username' => $request->login, 'password' => $request->password])
        ) {

            //$user = Auth::user();

            //dd($user);

            // if($user->accountStatus != "actived"){
            //     return $this->errorResponse('Unauthorized.', ['error' => 'this account is '.$user->accountStatus], 401);
            // }


            $response =  $this->issueToken($request);

            if($response->status() <=300){
                return  $this->successResponse( json_decode( $response->getContent()), "connected" ,$response->status());

            }

            return $this->errorResponse('Unauthorized', json_decode( $response->getContent()), $response->status() );

        }

        return $this->errorResponse('Incorrect login or password',null, Response::HTTP_UNAUTHORIZED);
    }
}
